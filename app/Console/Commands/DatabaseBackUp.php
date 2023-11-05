<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

class DatabaseBackUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = "backup-" . Carbon::now()->format('Y-m-d') . ".sql";
        $backupFilePath = storage_path('app/backup/' . $filename);

        $command = sprintf(
            'mysqldump --user=%s --host=%s %s  > %s',
            escapeshellarg(env('DB_USERNAME')),
            escapeshellarg(env('DB_HOST')),
            escapeshellarg(env('DB_DATABASE')),
            escapeshellarg($backupFilePath)
        );

        exec($command, $output, $returnVar);



    }
}
