<?php

namespace Numencode\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class Gulp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gulp:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Gulp for admin theme';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $command = "gulp --gulpfile gulpfile-admin.js";
        $process = new Process($command);
        $process->run();

        $output = $process->getOutput();

        $this->comment(strip_tags($output));
    }
}
