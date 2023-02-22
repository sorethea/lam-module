<?php

namespace Modules\LAM\Installer;

use Illuminate\Cache\CacheManager;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Modules\LAM\Contracts\InstallerInterface;
use Nwidart\Modules\Module;

class FileInstaller implements InstallerInterface
{
    private CacheManager $cache;

    private Filesystem $files;
    /**
     * @var \config|mixed
     */
    private $config;
    private $installedFile;
    private $cacheKey;
    private $cacheLifetime;
    private $installedModules;

    public function __construct(Container $app)
    {
        $this->cache = $app['cache'];
        $this->files = $app['files'];
        $this->config = $app['config'];
        $this->installedFile = $this->config('path');
        $this->cacheKey = $this->config('cache-key');
        $this->cacheLifetime = $this->config('cache-lifetime');
        $this->installedModules = $this->getInstalledModules();
    }

    public function install(Module $module): void
    {
        $this->setInstalledByName($module->getName(), true);
    }

    public function uninstall(Module $module): void
    {
        $this->setInstalledByName($module->getName(), false);
    }

    public function setInstalled(Module $module, bool $installed): void
    {
        $this->setInstalledByName($module->getName(), $installed);
    }

    public function setInstalledByName(string $name, bool $installed): void
    {
        $this->installedModules[$name] = $installed;
        $this->writeJson();
        $this->flushCache();
    }

    public function reset(): void
    {
        if ($this->files->exists($this->installedFile)) {
            $this->files->delete($this->installedFile);
        }
        $this->installedModules = [];
        $this->flushCache();
    }

    private function config(string $key, $default = null)
    {
        return $this->config->get('lam.installer.file.' . $key, $default);
    }

    private function getInstalledModules()
    {
        if (!$this->config->get('lam.cache.enabled',false)) {
            return $this->readJson();
        }

        return $this->cache->store($this->config->get('lam.cache.driver'))->remember($this->cacheKey, $this->cacheLifetime, function () {
            return $this->readJson();
        });
    }

    private function readJson(): array
    {
        if (!$this->files->exists($this->installedFile)) {
            return [];
        }

        return json_decode($this->files->get($this->installedFile), true);
    }

    private function writeJson(): void
    {
        $this->files->put($this->installedFile, json_encode($this->installedModules, JSON_PRETTY_PRINT));
    }

    private function flushCache(): void
    {
        $this->cache->store($this->config->get('lam.cache.driver'))->forget($this->cacheKey);
    }

    public function hasInstalled(Module $module, bool $installed): bool
    {
        if (!isset($this->installedModules[$module->getName()])) {
            return $installed === false;
        }
        return $this->installedModules[$module->getName()] === $installed;
    }

    public function delete(Module $module): void
    {
        if (!isset($this->installedModules[$module->getName()])) {
            return;
        }
        unset($this->installedModules[$module->getName()]);
        $this->writeJson();
        $this->flushCache();
    }
}
