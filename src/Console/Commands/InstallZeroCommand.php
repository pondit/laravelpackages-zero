<?php

namespace Mzr\Zero\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallZeroCommand extends Command
{
    protected $signature = 'zero:install';

    protected $description = 'Install the Zero Package';

    public function handle()
    {
        $this->info('Installing Zero...');

        $this->info('Publishing configuration...');
        
        //1. install configuration
        if (! $this->configExists('zero.php')) {
            $this->publishConfiguration();
            $this->info('Published configuration');
        } else {
            if ($this->shouldOverwriteConfig()) {
                $this->info('Overwriting configuration file...');
                $this->publishConfiguration($force = true);
            } else {
                $this->info('Existing configuration was not overwritten');
            }
        }
        
        $this->info('Installed Zero');
    }
    
    private function configExists($fileName)
    {
        return File::exists(config_path($fileName));
    }
    
    private function shouldOverwriteConfig()
    {
        return $this->confirm(
            'Config file already exists. Do you want to overwrite it?', 
            false
        );
    }

    private function publishConfiguration($forcePublish = false)
    {
        $params = [
            '--provider' => "Mzr\Zero\Providers\ZeroServiceProvider",
            '--tag' => "config"
        ];
        
        if ($forcePublish === true) {
            $params['--force'] = '';
        }

       $this->call('vendor:publish', $params);
    }
}


//note: stub
// https://github.com/beyondcode/laravel-package-tools/tree/master/src/Commands/stubs