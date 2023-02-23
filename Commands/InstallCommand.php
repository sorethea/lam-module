<?php

namespace Modules\LAM\Commands;

use Illuminate\Console\Command;
use Modules\LAM\Classes\Lam;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'lam:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install a specific module by given the module name.';

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
            \Lam::installModule($name);
            $this->components->info("Module {$name} install completed");
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
