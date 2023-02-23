<?php

namespace Modules\LAM\Classes;

use Illuminate\Container\Container;
use Modules\LAM\Contracts\InstallerInterface;

class LamModule extends \Nwidart\Modules\Laravel\Module
{


    private mixed $installer;

    public function __construct(Container $app, string $name, $path)
    {
        parent::__construct($app, $name, $path);
        $this->installer = $app[InstallerInterface::class];
    }
    public function installModule(){
        $this->installer->install($this);
    }
    public function uninstallModule(){
        $this->installer->uninstall($this);
    }
}
