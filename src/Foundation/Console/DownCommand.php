<?php

namespace Nova\Foundation\Console;

use Nova\Console\Command;


class DownCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'down';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Put the application into maintenance mode";

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        touch($this->nova['config']['app.manifest'].'/down');

        $this->comment('Application is now in maintenance mode.');
    }

}
