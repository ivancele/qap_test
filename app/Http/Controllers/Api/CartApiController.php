<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartApiController extends Controller
{
    public function addItem(Request $request){
        $product = Product::find($request->productID);
        
        \Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'associatedModel' => $product,
        ]);

        return response()->json([
            "error" => null,
            "message" => "Item added to cart",
        ]);
    }

    public function removeItem(Request $request){
        $product = Product::find($request->productID);
        \Cart::remove($product->id);
        return response()->json([
            "error" => null,
            "message" => "Item removed from cart",
        ]);
    }
}
