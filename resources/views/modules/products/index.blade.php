@extends('modules.products.base')

@section('header')
     Productos
@endsection


@section('content')
    <div class="py-0">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-splade-table :for="$products" striped search-debounce="500">
                <x-splade-cell stock as="$product">
                    @if(!$product->alert_stock)
                        <p class="font-bold text-success-500">{{ $product->full_stock_formated}}</p>
                    @else
                        <p class="font-bold text-danger-500">{{ $product->full_stock_formated }}</p>
                    @endif
                </x-splade-cell>
                <x-splade-cell acciones as="$product">
                    <div class="flex justify-around">
                        <Link modal href="{{ route('pr.stock-tiendas', [$product])}}"><i class="mr-1 text-xl text-primary-400 hover:text-primary-600 fi fi-br-boxes"></i></Link>
                        <Link rel="tooltip" title="Detalles de entrada" href="{{ route('pr.movements', [$product])}}"><i class="mr-1 text-xl text-alternative-400 hover:text-alternative-600 fi fi-br-arrows-retweet"></i></Link>
                        @can('pr:edit')
                            <Link href="{{ route('pr.edit', [$product])}}"><i class="mr-1 text-xl text-green-400 hover:text-green-600 fi fi-br-edit"></i></Link>
                        @endcan
                    </div>

                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
@endsection
