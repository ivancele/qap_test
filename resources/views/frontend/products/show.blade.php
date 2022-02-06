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

        {{-- Breadcrumb here? --}}
        <div class="col-md-9">
            <div class="row">
                <div class="col-6">
                    <img src="{{ $product->img_url}}" class="img-responsive img-fluid" />
                </div>

                <div class="col-6">
                    <h4 class="mb-4">{{ $product->name }}</h4>
                    <div class="d-flex justify-content-between align-items-center align-content-center">
                        <h6 >R{{ $product->price}}</h6>
                        <span>
                            <a href="" class="btn btn-rounded-30 btn-primary">Add to Cart</a>
                            <a href="" class="btn btn-rounded-30 btn-success">Buy Now</a>
                        </span>
                    </div>
                    <p class="text-justify mt-4">{{ $product->description }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            Right Pane
        </div>
    </div>
    <div class="row">
        {{-- Add Products from similar category/ies? --}}
    </div>
</div>
@endsection