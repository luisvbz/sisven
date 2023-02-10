<x-app-layout>
    <x-slot name="header">
        <x-back-button-title route="/" module="Productos" />
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                @can('pr:create')
                    <div class="flex p-3 mb-3 bg-white shadow-sm sm:rounded-lg">
                        <Link href="{{ route('pr.add') }}" class="button-primary"><span>Agregar</span> <i class="ml-2 fi fi-br-box"></i></Link>
                    </div>
                @endcan
                <div class="p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    <x-splade-table :for="$products" striped>
                        <x-splade-cell stock as="$product">
                            @if(!$product->alert_stock)
                                <p class="font-bold text-success-500">{{ $product->full_stock_formated}}</p>
                            @else
                                <p class="font-bold text-danger-500">{{ $product->full_stock_formated }}</p>
                            @endif
                        </x-splade-cell>
                    </x-splade-table>
                </div>
        </div>
    </div>
</x-app-layout>
