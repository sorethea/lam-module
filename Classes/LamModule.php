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
    public function install(){
        $this->installer->install($this);
    }
    public function uninstall(){
        $this->installer->uninstall($this);
    }

    public function isInstalled(): bool
    {
        return $this->installer->hasInstalled($this,true);
    }
    public function isSystem(): bool
    {
        return $this->json()->get('type')==="system";
    }
}
