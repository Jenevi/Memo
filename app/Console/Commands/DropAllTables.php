<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\DB;

use Illuminate\Console\Command;

class DropAllTables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'command:name';
    protected $signature = 'db:drop-all-tables';


    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'Command description';
    protected $description = 'Drop all tables from the database.';


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
    // public function handle()
    // {
    //     return 0;
    // }
    public function handle()
    {
        $this->comment('Dropping all tables...');

        $db = DB::connection()->getPdo();
        $dbname = DB::connection()->getDatabaseName();
        $tables = DB::select('SHOW TABLES');

        foreach ($tables as $table) {
            $tableName = $table->{"Tables_in_{$dbname}"};
            $db->exec("DROP TABLE IF EXISTS $tableName");
        }

        $this->info('All tables dropped successfully.');
    }

}
