<?php

use Illuminate\Support\Debug\Dumper;

if (! function_exists('d')) {
    /**
     * Dump the passed variables and end the script.
     *
     * @return void
     */
    function d()
    {
        array_map(function ($x) {
            (new Dumper)->dump($x);
        }, func_get_args());
    }
}

if (! function_exists('dd_query')) {
    $_global_query_count = 0;
    /**
     * Dump the next database query.
     *
     * @param int $count Number of queries to debug
     *
     * @return void
     */
    function dd_query($count = 1)
    {
        DB::listen(function ($query) use ($count) {
            global $_global_query_count;

            while (strpos($query->sql, '?')) {
                $query->sql = preg_replace('/\?/', '"' . array_shift($query->bindings) . '"', $query->sql, 1);
            }

            if (++$_global_query_count == $count) {
                dd($query->sql);
            } else {
                d($query->sql);
            }
        });
    }
}

if (!function_exists('ddt')) {
    /**
     * Dies and dumps a simple debug backtrace. Useful for console debugging
     *
     * @param int     $skip Number of last nodes to skip from the output
     * @param boolean $die  Die after dump
     *
     * @return void
     */
    function ddt($skip = 0, $die = true)
    {
        $stacks = debug_backtrace();
        $output = '';

        foreach ($stacks as $_stack) {
            if (!isset($_stack['file'])) {
                $_stack['file'] = '[PHP Kernel]';
            }
            if (!isset($_stack['line'])) {
                $_stack['line'] = '';
            }

            if ($skip <= 0) {
                $output .= "{$_stack['file']} : {$_stack['line']} - {$_stack['function']}" . PHP_EOL;
            }
            $skip--;
        }

        if ($die) {
            die($output);
        }

        d($output);
    }
}
