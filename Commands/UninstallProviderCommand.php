<?php

namespace Modules\LAM\Commands;

use Nwidart\Modules\Commands\GeneratorCommand;
use Nwidart\Modules\Support\Config\GenerateConfigReader;
use Modules\LAM\Support\Stub;
use Nwidart\Modules\Traits\ModuleCommandTrait;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class UninstallProviderCommand extends GeneratorCommand
{
    use ModuleCommandTrait;

    protected $argumentName = 'module';

    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'lam:uninstall-provider';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Create a new uninstall service provider for the specified module.';

    /**
     * The command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['module', InputArgument::REQUIRED, 'The name of module will be used.'],
        ];
    }

    protected function getOptions()
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when the file already exists.'],
        ];
    }

    /**
     * Get template contents.
     *
     * @return string
     */
    protected function getTemplateContents()
    {
        $module = $this->laravel['modules']->findOrFail($this->getModuleName());

        return (new Stub('/uninstall-provider.stub', [
            'NAMESPACE'            => $this->getClassNamespace($module),
            'CLASS'                => $this->getFileName(),
            'LOWER_NAME'           => $module->getLowerName(),
            'NAME'           => $module->getName(),
            'SEEDER' => $this->getSeeder(),
        ]))->render();
    }

    /**
     * @return string
     */
    private function getFileName()
    {
        return 'UninstallServiceProvider';
    }

    private function getSeeder()
    {
        $namespace = $this->laravel['modules']->config('namespace');
        $generatorPath =GenerateConfigReader::read('seeder');
        return $namespace. '\\'. $this->getModuleName() .'\\'. $generatorPath->getNamespace();
    }

    /**
     * Get the destination file path.
     *
     * @return string
     */
    protected function getDestinationFilePath()
    {
        $path = $this->laravel['modules']->getModulePath($this->getModuleName());

        $generatorPath = GenerateConfigReader::read('provider');

        return $path . $generatorPath->getPath() . '/' . $this->getFileName() . '.php';
    }


    public function getDefaultNamespace(): string
    {
        $module = $this->laravel['modules'];

        return $module->config('paths.generator.provider.namespace') ?: $module->config('paths.generator.provider.path', 'Providers');
    }
}
