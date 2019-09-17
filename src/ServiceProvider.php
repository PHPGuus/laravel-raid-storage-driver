<?php

namespace PHPGuus\RaidStorage;

use League\Flysystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use PHPGuus\FlysystemRaid\RaidOneAdapter;
use PHPGuus\RaidStorage\Console\RebuildRaidArray;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{
    public function boot()
    {
        Storage::extend('raid', function ($app, $config) {
            $fileSystems = [];
            foreach ($config['disks'] as $diskName) {
                $fileSystems[] = Storage::disk($diskName);
            }
            $raidLevel = $config['raidLevel'] ?? 1;

            if ($raidLevel == 1) {
                $adapter = new RaidOneAdapter($fileSystems);
            }

            return new Filesystem($adapter);
        });

        if ($this->app->runningInConsole()) {
            $this->commands([
               RebuildRaidArray::class,
           ]);
        }
    }
}
