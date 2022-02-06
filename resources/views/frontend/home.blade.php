@extends('layouts.frontend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Hi {{ Auth::user()->name }},  welcome to Diamond Holding Experience Store.</p>
                    <p>
                        Please take a moment and browse through our collection of the best <a href="{{ route('frontend.products.index')}}"> Products </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection