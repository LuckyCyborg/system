<?php

namespace Nova\Module\Console\Generators;

use Nova\Module\Console\Generators\MakeCommand;

use Symfony\Component\Console\Input\InputArgument;


class MakeSeederCommand extends MakeCommand
{
    /**
     * The name of the console command.
     *
     * @var string
     */
    protected $name = 'make:module:seeder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Module Seeder class';

    /**
     * String to store the command type.
     *
     * @var string
     */
    protected $type = 'Seeder';

    /**
     * Module folders to be created.
     *
     * @var array
     */
    protected $listFolders = array(
        'Database/Seeds/',
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
     * Module stubs used to populate defined files.
     *
     * @var array
     */
    protected $listStubs = array(
        'default' => array(
            'seeder_plus.stub',
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
        $this->container['filename']  = $this->makeFileName($filePath);
        $this->container['namespace'] = $this->getNamespace($filePath);

        $this->container['path'] = $this->getBaseNamespace();

        $this->container['classname'] = basename($filePath);
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
            '{{path}}',
            '{{namespace}}',
            '{{classname}}',
        );

        $replaces = array(
            $this->container['filename'],
            $this->container['path'],
            $this->container['namespace'],
            $this->container['classname'],
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
            array('name', InputArgument::REQUIRED, 'The name of the Seeder class.'),
        );
    }

}
