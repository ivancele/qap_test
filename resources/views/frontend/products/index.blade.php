@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center products">
        <div class="col-md-12">
            @can('product_create')
            <div class="col-12 d-flex justify-content-end align-content-center align-items-center">
                <a class="btn btn-success" href="{{ route('frontend.products.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.product.title_singular') }}
                </a>
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

            <div class="container-fluid">
                <span class="d-flex align-items-center align-content-center">
                    <a href="{{ route('frontend.home')}}">Home</a><i class="fas fa-angle-right px-1"></i>
                    <span>Products</span>
                </span>
            </div>

            <div class="row product-cards card-deck">
                @forelse ($products as $key=>$cproduct)
                <div class="col-md-4 p-2">
                    @include("frontend.products._productCard")
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

        //Add an onclick event to listen to add to cart btn and send a query to api endpoint to add to cart

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