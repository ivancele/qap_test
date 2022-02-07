@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            {{-- <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.product.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.products.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.product.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $product->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.product.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $product->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.product.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $product->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.product.fields.price') }}
                                    </th>
                                    <td>
                                        {{ $product->price }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.product.fields.category') }}
                                    </th>
                                    <td>
                                        @foreach($product->categories as $key => $category)
                                        <span class="label label-info">{{ $category->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.product.fields.tag') }}
                                    </th>
                                    <td>
                                        @foreach($product->tags as $key => $tag)
                                        <span class="label label-info">{{ $tag->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.product.fields.photo') }}
                                    </th>
                                    <td>
                                        @if($product->photo)
                                        <a href="{{ $product->photo->getUrl() }}" target="_blank"
                                            style="display: inline-block">
                                            <img src="{{ $product->photo->getUrl('thumb') }}">
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.products.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div> --}}

            <h3 class="text-center">Product Page</h3>
            <hr />
        </div>

        @canany(['product_edit', 'product_delete'])
        <div class="col-12 d-flex justify-content-end align-content-center align-items-center">
            {{-- Action btns for those with perms, user? and admin --}}
            @can('product_edit')
            <span class="btn btn-xs btn-info mx-2">
                <a class="btn btn-xs btn-info" href="{{ route('frontend.products.edit', $product->id) }}">
                    <i class="fas fa-pencil-alt"></i> {{ trans('global.edit') }}
                </a>
            </span>
            @endcan
            @can('product_delete')
            <form action="{{ route('frontend.products.destroy', $product->id) }}" method="POST"
                onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                class="d-flex justify-content-end align-content-center align-items-center">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <span class="btn btn-xs btn-danger" onclick="$(this).closest('form').submit();">
                    <i class="fas fa-trash-alt"></i> <input type="submit" class="btn-danger btn btn-xs"
                        value="{{ trans('global.delete') }}">
                </span>
            </form>
            @endcan
        </div>
        @endcan

        <div class="container-fluid">
            <span class="d-flex align-items-center align-content-center">
                <a href="{{ route('frontend.home')}}">Home</a><i class="fas fa-angle-right px-1"></i><a
                    href="{{ route('frontend.products.index')}}">Products</a><i
                    class="fas fa-angle-right px-1"></i><span>{{ $product->name }}</span>
            </span>
        </div>

        <div class="col-md-9 mt-4">
            <div class="row">
                <div class="col-6">
                    @if ($product->photo)
                        <img src="{{ $product->photo->getUrl() }}" class="img-responsive img-fluid" alt="Product Image" />
                    @else
                        <img src="{{ $product->img_url}}" class="img-responsive img-fluid" />
                    @endif
                </div>

                <div class="col-6">
                    <h4 class="mb-4">{{ $product->name }}</h4>
                    <div class="d-flex justify-content-between align-items-center align-content-center">
                        <h6>R{{ $product->price}}</h6>
                        <span>
                            <a href="" class="btn btn-rounded-30 btn-primary">Buy Now</a>
                            <a href="{{ route('frontend.product.addToCart', $product->id) }}" class="btn btn-rounded-30 btn-success"><i class="fas fa-cart-plus"></i> Add to Cart</a>
                        </span>
                    </div>
                    <hr />
                    <p class="text-center mt-4">{{ $product->description }}</p>
                    <hr />

                    {{-- Categories and tags --}}
                    <p>
                        @forelse ($product->categories as $category)
                        <span class="badge badge-pill badge-primary">
                            <a href="{{ route('frontend.products.getByCategory', $category->id) }}"
                                class="text-white nodeco">
                                <i class="fas fa-cubes"></i>
                                {{ $category->name }}
                            </a>
                        </span>
                        @empty

                        @endforelse

                        @forelse ($product->tags as $tag)
                        <span class="badge badge-pill badge-secondary">
                            <a href="{{ route('frontend.products.getByTag', $tag->id) }}" class="text-white nodeco">
                                <i class="fas fa-tags"></i>
                                {{ $tag->name }}
                            </a>
                        </span>
                        @empty

                        @endforelse
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            Right Pane
        </div>
    </div>
    <div class="my-4">
        <hr />
    </div>
    <div class="container mt-4 ">
        {{-- Add Products from similar category/ies? --}}
        <h4 class="text-center">Similar Products</h4>

        <div class="row product-cards card-deck mt-4">
            @forelse ($similarProducts as $category)
            @forelse ($category->products as $key=>$cproduct)
            @if($cproduct->id != $product->id)
            {{-- //Ensure current product doesn't show twice --}}
            <div class="col-md-4 p-2">
                @include("frontend.products._productCard")
            </div>
            @endif
            @empty

            @endforelse
            @empty

            @endforelse
        </div>
    </div>
</div>
@endsection