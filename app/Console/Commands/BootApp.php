<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BootApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dhe:boot-app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run this command to get the app setup';

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

        $this->info("We are setting everything up");

        $this->call('storage:link');
        $this->call('migrate:fresh');
        $this->call('db:seed');
        $this->call('dhe:add-products-categories');
        $this->call('dhe:create-products');

        $this->info("We are all setup, thank you for your patience, you can now login");

        return Command::SUCCESS;
    }
}
