<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearClockworkStorage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:clockwork';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleans all request metadata';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data_dir = storage_path() . '/clockwork';

        $this->info('Cleaning ' . $data_dir . ' ...');

        $files = glob($data_dir . '/*.json');

        if (!$files || !count($files)) {
            $this->info('Nothing to clean up.');
            return;
        }

        $count = 0;
        foreach ($files as $file) {
            unlink($file);
            $count++;
        }

        $this->info($count . ' files removed.');
    }
}
