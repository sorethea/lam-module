<?php

namespace Modules\LAM\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class UninstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'lam:uninstall';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Uninstall a specific module by given the module name.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() :int
    {
        if ($name = $this->argument('module') ) {
            $module = \Lam::uninstallModule($name);
            $this->components->info("Module {$module->getName()} uninstall completed");
            return 1;
        }
        return 0;

    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['module', InputArgument::REQUIRED, 'Module name is required.'],
        ];
    }

}
