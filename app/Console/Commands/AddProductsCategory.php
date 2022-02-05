<?php

namespace App\Console\Commands;

use App\Models\ProductCategory;
use Illuminate\Console\Command;

class AddProductsCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dhe:add-products-category {category : Category name, e.g. Rings, Necklaces, etc} {--description=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert a single product category';

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
        $categoryName = $this->argument('category');
        $categoryDescription = $this->option('description') ?? null;

        $category = [
            'name' => $categoryName,
            'description' => $categoryDescription,
        ];

        $this->info("Processing product category...");

        $similarCategories = ProductCategory::where('name', 'LIKE', "%" . strtolower($categoryName) . "%")->get();
        if ($similarCategories->count() > 0) {
            $this->warn($similarCategories->count()." similar categories found");
            
            foreach($similarCategories as $similarCategory) {
                $this->error("Similar Category is $similarCategory->name $similarCategory->description  created on $similarCategory->created_at");
            }

            return Command::SUCCESS;
        }

        if (ProductCategory::create($category)) {
            $this->info("Category successfully added");
            $this->table(
                ["Category Name", "Description"],
                [
                    [$categoryName, $categoryDescription],
                ]
            );
        } else {
            $this->error("An error occured while creating category");
        }

        return Command::SUCCESS;
    }

}
