<?php

namespace App\Console\Commands;

use App\Models\ProductCategory;
use Illuminate\Console\Command;

class ListProductCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dhe:list-product-categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all product categories in the db';

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
        $headers = ['Category', 'Description', 'Date Created'];
        $productCategories = ProductCategory::all(['name', 'description', 'created_at']);
        
        $rows = [];
        
        foreach($productCategories as $category){
            // $this->info("Category: " . $category->name);
            array_push($rows, [ucwords($category->name), $category->description, $category->created_at]);
        }
        $this->info("Here is the list of all registered categories");
        $this->table($headers, $rows);
        return Command::SUCCESS;
    }
}
