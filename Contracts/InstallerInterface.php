<?php

namespace Modules\LAM\Contracts;

use Nwidart\Modules\Module;

interface InstallerInterface
{

    public function install(Module $module): void;

    public function uninstall(Module $module): void;

    public function hasInstalled(Module $module, bool $installed): bool;

    public function setInstalled(Module $module, bool $installed): void;

    public function setInstalledByName(string $name, bool $installed): void;

    public function delete(Module $module): void;

    public function reset(): void;
}
