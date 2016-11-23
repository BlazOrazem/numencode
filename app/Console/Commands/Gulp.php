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
    protected $signature = 'admin:gulp';

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

        foreach (explode("\n", $process->getOutput()) as $line) {
            $this->comment($this->clean($line));
        }

        if ($process->isSuccessful()) {
            $this->info('Gulp for the admin theme executed successfully.' . "\n");
        } else {
            $this->error('Error executing Gulp for the admin theme.' . "\n");
        }
    }

    /**
     * Clean special characters from Gulp log.
     *
     * @param string $string String
     *
     * @return string
     */
    protected function clean($string)
    {
        $string = str_replace(
            ['┌','┐','└','┘','─','│','┼','┬','┴','├','┤'],
            [''],
            $string
        );

        $output = preg_replace('!\s+!', ' ', $string);

        $output = str_replace('() 1.', '()' . PHP_EOL . ' 1.', $output);

        return $output;
    }
}
