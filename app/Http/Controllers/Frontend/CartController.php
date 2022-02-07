<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;

class CartController extends Controller
{

    public function addtocart(Product $product)
    {
        $cart = \Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'associatedModel' => $product,
        ]);

        session()->flash('success', "Product $product->name successfully added to cart!");

        return redirect()->back();
    }

    public function show()
    {
        $cart = \Cart::getContent();

        return view('frontend.cart.index', compact('cart'));
    }

    public function clearCart(){
        \Cart::clear();
        session()->flash('success', 'Your Cart has been cleared!');

        return redirect()->route('frontend.cart.show');
    }

}
