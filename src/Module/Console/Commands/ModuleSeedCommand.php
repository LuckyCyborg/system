<?php

namespace Nova\Module\Console\Commands;

use Nova\Console\Command;
use Nova\Console\ConfirmableTrait;
use Nova\Module\ModuleRepository;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;


class ModuleSeedCommand extends Command
{
    use ConfirmableTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the database with records for a specific or all modules';

    /**
     * @var \Nova\Module\ModuleRepository
     */
    protected $module;

    /**
     * Create a new command instance.
     *
     * @param \Nova\Module\ModuleRepository $module
     */
    public function __construct(ModuleRepository $module)
    {
        parent::__construct();

        $this->module = $module;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        if (! $this->confirmToProceed()) return;

        $slug = $this->argument('slug');

        if (isset($slug)) {
            if (!$this->module->exists($slug)) {
                return $this->error('Module does not exist.');
            }

            if ($this->module->isEnabled($slug)) {
                $this->seed($slug);
            } elseif ($this->option('force')) {
                $this->seed($slug);
            }

            return;
        }

        if ($this->option('force')) {
            $modules = $this->module->all();
        } else {
            $modules = $this->module->enabled();
        }

        foreach ($modules as $module) {
            $this->seed($module['slug']);
        }
    }

    /**
     * Seed the specific module.
     *
     * @param string $module
     *
     * @return array
     */
    protected function seed($slug)
    {
        $module = $this->module->where('slug', $slug);

        $params = array();

        $namespacePath = $this->module->getNamespace();

        $rootSeeder = $module['namespace'] .'DatabaseSeeder';

        $fullPath   = $namespacePath .'\\' .$module['namespace'] .'\Database\Seeds\\' .$rootSeeder;

        if (! class_exists($fullPath)) {
            return;
        }

        if ($this->option('class')) {
            $params['--class'] = $this->option('class');
        } else {
            $params['--class'] = $fullPath;
        }

        if ($option = $this->option('database')) {
            $params['--database'] = $option;
        }

        if ($option = $this->option('force')) {
            $params['--force'] = $option;
        }

        $this->call('db:seed', $params);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [['slug', InputArgument::OPTIONAL, 'Module slug.']];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('class', null, InputOption::VALUE_OPTIONAL, 'The class name of the module\'s root seeder.'),
            array('database', null, InputOption::VALUE_OPTIONAL, 'The database connection to seed.'),
            array('force', null, InputOption::VALUE_NONE, 'Force the operation to run while in production.'),
        );
    }
}
