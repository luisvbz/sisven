@extends('modules.orders.base')

@section('header')
     Compras
@endsection


@section('content')
    <div class="py-0">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-splade-table :for="$orders">
                <x-splade-cell estado as="$order" class="text-center">
                     @if($order->status == App\Models\Order::PROCCESED)
                        <div class="w-full text-center">
                            <span class="bg-green-500 p-1 text-[0.70rem] text-white rounded font-semibold">PROCESADA</span>
                        </div>
                     @endif
                </x-splade-cell>
                <x-splade-cell acciones as="$order">
                <div class="w-full">
                    <span class="p-1 text-[0.70rem] text-primary-600 font-semibold uppercase">
                        <Link href="{{ route('co.details', [$order]) }}">
                                Ver detalles <i class="fi fi-br-link-alt"></i>
                        </Link>
                    </span>
                </div>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
@endsection
