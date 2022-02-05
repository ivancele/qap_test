@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center products">
        <div class="col-md-12">
            @can('product_create')
            <div style="margin-bottom: 10px;" class="row">
                <div class="col-lg-12">
                    <a class="btn btn-success" href="{{ route('frontend.products.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.product.title_singular') }}
                    </a>
                </div>
            </div>
            @endcan
            {{-- <div class="card">
                <div class="card-header">
                    {{ trans('cruds.product.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Product">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.product.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.product.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.product.fields.description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.product.fields.price') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.product.fields.category') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.product.fields.tag') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.product.fields.photo') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $key => $product)
                                <tr data-entry-id="{{ $product->id }}">
                                    <td>
                                        {{ $product->id ?? '' }}
                                    </td>
                                    <td>
                                        {{ $product->name ?? '' }}
                                    </td>
                                    <td>
                                        {{ $product->description ?? '' }}
                                    </td>
                                    <td>
                                        {{ $product->price ?? '' }}
                                    </td>
                                    <td>
                                        @foreach($product->categories as $key => $item)
                                        <span>{{ $item->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($product->tags as $key => $item)
                                        <span>{{ $item->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if($product->photo)
                                        <a href="{{ $product->photo->getUrl() }}" target="_blank"
                                            style="display: inline-block">
                                            <img src="{{ $product->photo->getUrl('thumb') }}">
                                        </a>
                                        @endif
                                    </td>
                                    <td>
                                        @can('product_show')
                                        <a class="btn btn-xs btn-primary"
                                            href="{{ route('frontend.products.show', $product->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                        @endcan

                                        @can('product_edit')
                                        <a class="btn btn-xs btn-info"
                                            href="{{ route('frontend.products.edit', $product->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                        @endcan

                                        @can('product_delete')
                                        <form action="{{ route('frontend.products.destroy', $product->id) }}"
                                            method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger"
                                                value="{{ trans('global.delete') }}">
                                        </form>
                                        @endcan

                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}

            <div class="row product-cards card-deck">
                @forelse ($products as $key=>$product)
                <div class="col-md-4 p-2">
                    <div class="card rounded-0">
                        <div class="card-header d-flex justify-content-between">
                            <span class="price">R{{$product->price}}</span>
                            <span class="btn-right">
                                <span><i class="fas fa-lg mx-2 fa-info-circle"></i></span>
                                <span><i class="fas fa-lg mx-2 fa-heart"></i></span>
                                <span><i class="fas fa-lg mx-2 fa-cart-plus"></i></span>
                            </span>
                        </div>
                        @if($product->photo)
                        @elseif($product->img_url)
                        <img src="{{$product->img_url}}" class="card-img-top img-fluid m-2" alt="...">
                        @endif
                        <div class="card-body">
                            <h4 class="text-center">{{$product->name}}</h4>
                            {{-- //REVIEW: displaying the description here seems to make it cluttered with too much
                            information --}}
                        </div>

                        <div class="card-footer">
                            <div class="btn-group row w-100 rounded-0">
                                @can('product_show')
                                <a class="btn btn-primary col-6 rounded-0" href="{{ route('frontend.products.show', $product->id) }}">
                                    More Info
                                </a>
                                @endcan
                                <a class="btn btn-success col-6 rounded-0" href="{{ route('frontend.products.show', $product->id) }}">
                                    <i class="fas fa-cart-plus"></i> Add to Cart
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <p>No Products Listed yet</p>
                @endforelse
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('product_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.products.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Product:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection