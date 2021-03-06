<?php

namespace Nova\Module\Repositories;

use Nova\Config\Repository as Config;
use Nova\Helpers\Inflector;
use Nova\Filesystem\Filesystem;
use Nova\Module\RepositoryInterface;
use Nova\Support\Str;


abstract class Repository implements RepositoryInterface
{
    /**
     * @var \Nova\Config\Repository
     */
    protected $config;

    /**
     * @var \Nova\Filesystem\Filesystem
     */
    protected $files;

    /**
     * @var string Path to the defined Modules directory
     */
    protected $path;

    /**
     * Constructor method.
     *
     * @param \Nova\Config\Repository     $config
     * @param \Nova\Filesystem\Filesystem $files
     */
    public function __construct(Config $config, Filesystem $files)
    {
        $this->config = $config;
        $this->files  = $files;
    }

    /**
     * Get all module basenames.
     *
     * @return array
     */
    protected function getAllBasenames()
    {
        $path = $this->getPath();

        try {
            $collection = collect($this->files->directories($path));

            $basenames = $collection->map(function ($item, $key) {
                return basename($item);
            });

            return $basenames;
        } catch (\InvalidArgumentException $e) {
            return collect(array());
        }
    }

    /**
     * Get a module's manifest contents.
     *
     * @param string $slug
     *
     * @return Collection|null
     */
    public function getManifest($slug)
    {
        if (is_null($slug)) {
            return;
        }

        $module = Str::slug($slug);

        $path = $this->getManifestPath($module);

        $contents = $this->files->get($path);

        $collection = collect(json_decode($contents, true));

        return $collection;
    }

    /**
     * Get modules path.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path ?: $this->config->get('modules.path');
    }

    /**
     * Set modules path in "RunTime" mode.
     *
     * @param string $path
     *
     * @return object $this
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path for the specified module.
     *
     * @param string $slug
     *
     * @return string
     */
    public function getModulePath($slug)
    {
        $module = Inflector::classify($slug);

        return $this->getPath() .DS .$module .DS;
    }

    /**
     * Get path of module manifest file.
     *
     * @param string $module
     *
     * @return string
     */
    protected function getManifestPath($slug)
    {
        return $this->getModulePath($slug) .'module.json';
    }

    /**
     * Get modules namespace.
     *
     * @return string
     */
    public function getNamespace()
    {
        return rtrim($this->config->get('modules.namespace'), '/\\');
    }
}
