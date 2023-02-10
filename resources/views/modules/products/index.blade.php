<x-app-layout>
    <x-slot name="header">
        <x-back-button-title route="/" module="Productos" />
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                @can('pr:create')
                    <div class="flex p-3 mb-3 bg-white shadow-lg sm:rounded-lg">
                        <Link href="{{ route('pr.add') }}" class="button-primary"><span>Agregar</span> <i class="ml-2 fi fi-br-box"></i></Link>
                    </div>
                @endcan
                <div class="p-6 bg-white border-b border-gray-200 shadow-lg sm:rounded-lg">
                    <x-splade-table :for="$products" striped>
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
                                @can('pr:edit')
                                    <Link href="{{ route('pr.edit', [$product])}}"><i class="mr-1 text-xl text-green-400 hover:text-green-600 fi fi-br-edit"></i></Link>
                                @endcan
                            </div>

                        </x-splade-cell>
                    </x-splade-table>
                </div>
        </div>
    </div>
</x-app-layout>
