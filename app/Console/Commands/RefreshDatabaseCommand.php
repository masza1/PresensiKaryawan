<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RefreshDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command will Rollback, Migrate, and Seed the databases';

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
        $this->call('migrate:refresh');
        $this->call('db:seed');
        $this->info('All databases has been rollback and migrated');
        $this->info('All databases has been filled with seeder data');
        
        return 0;
    }
}
