<?php

namespace Nova\Module\Console\Generators;

use Nova\Helpers\Inflector;
use Nova\Module\Console\Generators\MakeCommand;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;


class MakeMigrationCommand extends MakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:module:migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Module Migration file';

    /**
     * String to store the command type.
     *
     * @var string
     */
    protected $type = 'Migration';

    /**
     * Module folders to be created.
     *
     * @var array
     */
    protected $listFolders = array(
        'Database/Migrations/',
    );

    /**
     * Module files to be created.
     *
     * @var array
     */
    protected $listFiles = array(
        '{{filename}}.php',
    );

    /**
     * Module signature option.
     *
     * @var array
     */
    protected $signOption = array(
        'create',
        'table',
    );

    /**
     * Module stubs used to populate defined files.
     *
     * @var array
     */
    protected $listStubs = array(
        'default' => array(
            'migration.stub',
        ),
        'create' => array(
            'migration_create.stub',
        ),
        'table' => array(
            'migration_table.stub',
        ),
    );

    /**
     * Resolve Container after getting file path.
     *
     * @param string $FilePath
     *
     * @return array
     */
    protected function resolveByPath($filePath)
    {
        $this->container['filename'] = $this->makeFileName($filePath);

        $this->container['classname'] = basename($filePath);
        $this->container['tablename'] = 'dummy';
    }

    /**
     * Resolve Container after getting input option.
     *
     * @param string $option
     *
     * @return array
     */
    protected function resolveByOption($option)
    {
        $this->container['tablename'] = $option;
    }

    /**
     * Make FileName.
     *
     * @param string $filePath
     *
     * @return string
     */
    protected function makeFileName($filePath)
    {
        return date('Y_m_d_His') .'_' .strtolower(Inflector::tableize(basename($filePath)));
    }

    /**
     * Replace placeholder text with correct values.
     *
     * @return string
     */
    protected function formatContent($content)
    {
        $searches = array(
            '{{filename}}',
            '{{classname}}',
            '{{tablename}}',
        );

        $replaces = array(
            $this->container['filename'],
            $this->container['classname'],
            $this->container['tablename'],
        );

        return str_replace($searches, $replaces, $content);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('slug', InputArgument::REQUIRED, 'The slug of the Module.'),
            array('name', InputArgument::REQUIRED, 'The name of the Migration.'),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('--create', null, InputOption::VALUE_OPTIONAL, 'The table to be created.'),
            array('--table',  null, InputOption::VALUE_OPTIONAL, 'The table to migrate.'),
        );
    }
}
