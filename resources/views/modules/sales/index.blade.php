@extends('modules.sales.base')

@section('header')
     Ventas
@endsection

@section('content')
    <div class="py-0">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-splade-table :for="$sales">
                <x-splade-cell Estado as="$sale">
                     @if($sale->status == 'proccesed')
                        <div class="w-full">
                            <span class="bg-green-500 p-1 text-[0.70rem] text-white rounded font-semibold">PROCESADA</span>
                        </div>
                     @endif
                </x-splade-cell>
                <x-splade-cell Fecha as="$sale">
                    {{ $sale->created_at->format('d/m/Y') }}
                </x-splade-cell>
                <x-splade-cell total as="$sale">
                    {{ $sale->total_formated }}
                </x-splade-cell>
                <x-splade-cell acciones as="$sale">
                    <div class="flex justify-around">
                      <Link href="{{ route('ve.show', [$sale])}}"><i class="mr-1 text-xl text-blue-400 hover:text-blue-600 fi fi-br-search"></i></Link>
                    </div>

                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
@endsection
