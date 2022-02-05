<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CreateProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dhe:create-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Generic Products';

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
        $url = "https://fakestoreapi.com/products";
        $query = Http::get($url);
        if ($query->successful()) {
            $result = json_decode($query->body());
            $this->output->progressStart(count($result));

            $productCategories = ProductCategory::all();

            foreach ($result as $product) {
                // \Log::debug($product->title." ".$product->image);
                $p = Product::create([
                    'name' => $product->title,
                    'description' => $product->description,
                    'price' => $product->price,
                    'img_url' => $product->image,
                ]);

                $p->categories()->sync($productCategories->random(2));

                $this->output->progressAdvance();
            }

            $this->output->progressFinish();
        }
        return Command::SUCCESS;
    }
}
