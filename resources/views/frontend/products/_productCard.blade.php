@if($cproduct)
<div class="card rounded-0">
    <div class="card-header d-flex justify-content-between">
        <span class="price">R{{$cproduct->price}}</span>
        <span class="btn-right">
            <span><i class="fas fa-lg mx-2 fa-info-circle"></i></span>
            <span><i class="fas fa-lg mx-2 fa-heart"></i></span>
            <span><i class="fas fa-lg mx-2 fa-cart-plus"></i></span>
        </span>
    </div>
    @if($cproduct->photo)
    @elseif($cproduct->img_url)
    <img src="{{$cproduct->img_url}}" class="card-img-top img-fluid m-2" alt="...">
    @endif
    <div class="card-body">
        <h4 class="text-center">{{$cproduct->name}}</h4>
        {{-- //REVIEW: displaying the description here seems to make it cluttered with too much
        information --}}
    </div>

    <div class="card-footer m-0 p-0">
        <div class="btn-group w-100 rounded-0">
            @can('product_show')
            <a class="btn btn-primary col-6 rounded-0" href="{{ route('frontend.products.show', $cproduct->id) }}">
                More Info
            </a>
            @endcan
            <a class="btn btn-success col-6 rounded-0" href="{{ route('frontend.products.show', $cproduct->id) }}">
                <i class="fas fa-cart-plus"></i> Add to Cart
            </a>
        </div>
    </div>
</div>
@endif