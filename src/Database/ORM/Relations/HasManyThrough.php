<?php

namespace Nova\Database\ORM\Relations;

use Nova\Database\ORM\Model;
use Nova\Database\ORM\Builder;
use Nova\Database\Query\Expression;
use Nova\Database\ORM\Collection;


class HasManyThrough extends Relation
{
    /**
     * The distance parent model instance.
     *
     * @var \Nova\Database\ORM\Model
     */
    protected $farParent;

    /**
     * The near key on the relationship.
     *
     * @var string
     */
    protected $firstKey;

    /**
     * The far key on the relationship.
     *
     * @var string
     */
    protected $secondKey;


    /**
     * Create a new has many relationship instance.
     *
     * @param  \Nova\Database\ORM\Builder  $query
     * @param  \Nova\Database\ORM\Model  $parent
     * @param  string  $firstKey
     * @param  string  $secondKey
     * @return void
     */
    public function __construct(Builder $query, Model $farParent, Model $parent, $firstKey, $secondKey)
    {
        $this->firstKey  = $firstKey;
        $this->secondKey = $secondKey;
        $this->farParent = $farParent;

        parent::__construct($query, $parent);
    }

    /**
     * Set the base constraints on the relation query.
     *
     * @return void
     */
    public function addConstraints()
    {
        $parentTable = $this->parent->getTable();

        $this->setJoin();

        if (static::$constraints) {
            $this->query->where($parentTable.'.'.$this->firstKey, '=', $this->farParent->getKey());
        }
    }

    /**
     * Add the constraints for a relationship count query.
     *
     * @param  \Nova\Database\ORM\Builder  $query
     * @param  \Nova\Database\ORM\Builder  $parent
     * @return \Nova\Database\ORM\Builder
     */
    public function getRelationCountQuery(Builder $query, Builder $parent)
    {
        $parentTable = $this->parent->getTable();

        $this->setJoin($query);

        $query->select(new Expression('count(*)'));

        $key = $this->wrap($parentTable.'.'.$this->firstKey);

        return $query->where($this->getHasCompareKey(), '=', new Expression($key));
    }

    /**
     * Set the join clause on the query.
     *
     * @param  \Nova\Database\ORM\Builder|null  $query
     * @return void
     */
    protected function setJoin(Builder $query = null)
    {
        $query = $query ?: $this->query;

        $foreignKey = $this->related->getTable().'.'.$this->secondKey;

        $query->join($this->parent->getTable(), $this->getQualifiedParentKeyName(), '=', $foreignKey);
    }

    /**
     * Set the constraints for an eager load of the relation.
     *
     * @param  array  $models
     * @return void
     */
    public function addEagerConstraints(array $models)
    {
        $table = $this->parent->getTable();

        $this->query->whereIn($table.'.'.$this->firstKey, $this->getKeys($models));
    }

    /**
     * Initialize the relation on a set of models.
     *
     * @param  array   $models
     * @param  string  $relation
     * @return array
     */
    public function initRelation(array $models, $relation)
    {
        foreach ($models as $model) {
            $model->setRelation($relation, $this->related->newCollection());
        }

        return $models;
    }

    /**
     * Match the eagerly loaded results to their parents.
     *
     * @param  array   $models
     * @param  \Nova\Database\ORM\Collection  $results
     * @param  string  $relation
     * @return array
     */
    public function match(array $models, Collection $results, $relation)
    {
        $dictionary = $this->buildDictionary($results);

        // Once we have the dictionary we can simply spin through the parent models to
        // link them up with their children using the keyed dictionary to make the
        // matching very convenient and easy work. Then we'll just return them.
        foreach ($models as $model) {
            $key = $model->getKey();

            if (isset($dictionary[$key]))  {
                $value = $this->related->newCollection($dictionary[$key]);

                $model->setRelation($relation, $value);
            }
        }

        return $models;
    }

    /**
     * Build model dictionary keyed by the relation's foreign key.
     *
     * @param  \Nova\Database\ORM\Collection  $results
     * @return array
     */
    protected function buildDictionary(Collection $results)
    {
        $dictionary = array();

        $foreign = $this->farParent->getForeignKey();

        // First we will create a dictionary of models keyed by the foreign key of the
        // relationship as this will allow us to quickly access all of the related
        // models without having to do nested looping which will be quite slow.
        foreach ($results as $result) {
            $dictionary[$result->{$foreign}][] = $result;
        }

        return $dictionary;
    }

    /**
     * Get the results of the relationship.
     *
     * @return mixed
     */
    public function getResults()
    {
        return $this->get();
    }

    /**
     * Execute the query and get the first result.
     *
     * @param  array  $columns
     * @return \Nova\Database\ORM\Model|static|null
     */
    public function first($columns = array('*'))
    {
        $results = $this->take(1)->get($columns);

        return (count($results) > 0) ? $results->first() : null;
    }

    /**
     * Execute the query as a "select" statement.
     *
     * @param  array  $columns
     * @return \Nova\Database\ORM\Collection
     */
    public function get($columns = array('*'))
    {
        $select = $this->getSelectColumns($columns);

        $models = $this->query->addSelect($select)->getModels();

        // If we actually found models we will also eager load any relationships that
        // have been specified as needing to be eager loaded. This will solve the
        // n + 1 query problem for the developer and also increase performance.
        if (count($models) > 0) {
            $models = $this->query->eagerLoadRelations($models);
        }

        return $this->related->newCollection($models);
    }

    /**
     * Get a paginator for the "select" statement.
     *
     * @param  int    $perPage
     * @param  array  $columns
     * @return \Pagination\Paginator
     */
    public function paginate($perPage = null, $columns = array('*'))
    {
        $select = $this->getSelectColumns($columns);

        $this->query->addSelect($select);

        return $this->query->paginate($perPage, $columns);
    }

    /**
     * Set the select clause for the relation query.
     *
     * @return \Nova\Database\ORM\Relations\BelongsToMany
     */
    protected function getSelectColumns(array $columns = array('*'))
    {
        if ($columns == array('*')) {
            $columns = array($this->related->getTable().'.*');
        }

        return array_merge($columns, array($this->parent->getTable() .'.' .$this->firstKey));
    }

    /**
     * Get the key name of the parent model.
     *
     * @return string
     */
    protected function getQualifiedParentKeyName()
    {
        return $this->parent->getQualifiedKeyName();
    }

    /**
     * Get the key for comparing against the parent key in "has" query.
     *
     * @return string
     */
    public function getHasCompareKey()
    {
        return $this->farParent->getQualifiedKeyName();
    }

}
