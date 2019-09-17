<?php

namespace PHPGuus\RaidStorage\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use PHPGuus\FlysystemRaid\RaidOneAdapter;

class RebuildRaidArray extends Command
{
    //region Public Access

    /**
     * Rebuild the RAID array underlying the given Storage disk name
     */
    public function handle()
    {
        $disk = $this->argument('disk');
        if (!$disk) {
            $this->error('Please provide the disk you want the RAID ' .
                'configuration to be rebuilt for.');
            return;
        }

        $diskConfig = config('filesystems.disks.' . $disk);
        if (!$diskConfig) {
            $this->error('Cannot find the filesystem configuration for disk "' .
                $disk . '".');
            return;
        }

        $fileSystems = [];
        if(!isset($diskConfig['disks'])) {
            $this->error('Please make sure you have a key "disks" in the ' .
                'configuration of the disk "' . $disk . '".');
            return;
        }
        foreach($diskConfig['disks'] as $diskName) {
            $fileSystems[] = Storage::disk($diskName);
        }

        $raidLevel = $diskConfig['raidLevel'] ?? 1;
        if($raidLevel == 1) {
            $adapter = new RaidOneAdapter($fileSystems);
            $adapter->rebuildArray();
        }
    }

    //endregion

    //region Protected Attributes

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rebuild the RAID array underlying a Storage disk';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'raid:rebuild-array {disk : The configured disk ' .
        'for which to rebuild the array}';

    //endregion
}