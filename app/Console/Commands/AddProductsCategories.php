<?php

namespace App\Console\Commands;

use App\Models\ProductCategory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class AddProductsCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dhe:add-products-categories {categories?* : You can also pass in categories}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates multiple products categories, from args or it returns existing categories';

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
        $categories = ['Rings', 'Necklaces', 'Bracelets', 'Anklets'];

        //Get Other categories from an API make life easier
        $url = "https://fakestoreapi.com/products/categories";
        $apiCategories = Http::get($url);

        if ($apiCategories->successful()) {
            foreach (array_merge($categories, json_decode($apiCategories)) as $category) {
               $this->createEntry($category);
            }
        } else {
            foreach ($categories as $category) {
                $this->createEntry($category);
            }
        }

        //Execute the below command to display all registered categories
        $this->call('dhe:list-product-categories');

        return Command::SUCCESS;
    }

    private function createEntry($category)
    {
        if(ProductCategory::where('name', 'like', "%$category%")->get()->count() == 0) {
            ProductCategory::create(['name' => $category]);
        }
    }
}
