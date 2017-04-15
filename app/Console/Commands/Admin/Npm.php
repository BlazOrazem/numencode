<?php

namespace Numencode\Console\Commands\Admin;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class Npm extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:npm';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run NPM update for admin theme';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $command = 'cd modules/Admin/Resources/assets/vendor && npm install';
        $process = new Process($command);
        $process->run();

        $this->comment($process->getOutput());

        if ($process->isSuccessful()) {
            $this->info('NPM update for the admin theme executed successfully.' . "\n");
        } else {
            $this->error('Error executing NPM update for the admin theme.' . "\n");
        }
    }
}
