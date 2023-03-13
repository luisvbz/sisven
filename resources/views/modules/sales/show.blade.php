@extends('modules.sales.base')

@section('header')
     Detalle de venta
@endsection

@section('content')
    <div class="py-0">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            {{ $sale->total }}
        </div>
    </div>
@endsection
