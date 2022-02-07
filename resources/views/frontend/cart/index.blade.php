@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="text-center">Cart</h3>
            <hr />
        </div>

        <div class="container-fluid">
            <span class="d-flex align-items-center align-content-center">
                <a href="{{ route('frontend.home')}}">Home</a>
                <i class="fas fa-angle-right px-1"></i>
                <span>Cart</span>
            </span>

            <div class="cartTable mt-4 table-responsive">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Sub Total</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cart as $item)
                        <tr>
                            <th scope="row">1</th>
                            <td>{{ $item->associatedModel->name }}</td>
                            <td>R{{ $item->associatedModel->price }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>R{{ number_format($item->associatedModel->price * $item->quantity, 2) }}</td>
                            <td class="text-danger">
                                <i onclick="removeFromCart({{$item->associatedModel->id}})" class="fas fa-trash-alt"></i>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">
                                <p class="alert alert-info">Your Cart is empty, shop some <a href="{{ route('frontend.products.index')}}">products</a> from our catalog</p>
                            </td>
                        </tr>
                        @endforelse
                        <tr>
                            <th colspan="5" class="text-uppercase">Grand Total</th>
                            <th
                                class="text-uppercase d-flex justify-content-center align-items-center align-content-center">
                                R{{ number_format(\Cart::getTotal(), 2)}}</th>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">
                                <a href="{{ route('frontend.cart.clear')}}" type="button" class="btn btn-sm btn-warning">Clear Cart</a>
                                <button type="button" class="btn btn-sm btn-primary rounded-30">Update Cart</button>
                                <button type="button" class="btn btn-sm btn-success">Checkout</button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{{-- Add a function to update quantity as value changes, todo --}}
@endsection