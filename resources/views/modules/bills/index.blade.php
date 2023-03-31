@extends('modules.bills.base')

@section('header')
     Documentos Electrónicos
@endsection

@section('content')
    <div class="py-0">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-splade-table :for="$bills">
                <x-splade-cell estado as="$bill">
                    @if($bill->status == 'proccesed')
                       <div class="w-full">
                            <span class="bg-green-500 p-1 text-[0.70rem] text-white rounded font-semibold">PROCESADA</span>
                        </div>
                    @else
                        <div class="w-full">
                            <span class="bg-red-500 p-1 text-[0.70rem] text-white rounded font-semibold">ANULADA</span>
                        </div>
                    @endif
                </x-splade-cell>
                <x-splade-cell tipo as="$bill">
                    @if($bill->type == 'FACT')
                        <span class="text-xs">FACTURA</span>
                    @elseif($bill->type == 'BOL')
                        <span class="text-xs">BOLETA</span>
                    @elseif($bill->type == 'NDD')
                        <span class="text-xs">NOTA DE DEBITO</span>
                    @elseif($bill->type == 'NDC')
                        <span class="text-xs">NOTA DE CRÉDITO</span>
                    @endif
                </x-splade-cell>
                <x-splade-cell numero as="$bill">
                   <span class="text-xs">
                    {{ $bill->serie}}-{{$bill->number }}
                   </span>
                </x-splade-cell>
                <x-splade-cell gravada as="$bill">
                   <span class="text-xs">
                    {{ $bill->total_gravada_formated}}
                   </span>
                </x-splade-cell>
                <x-splade-cell igv as="$bill">
                   <span class="text-xs">
                    {{ $bill->total_igv_formated}}
                   </span>
                </x-splade-cell>
                <x-splade-cell total as="$bill">
                   <span class="text-xs">
                    {{ $bill->total_formated}}
                   </span>
                </x-splade-cell>
                <x-splade-cell archivo as="$bill">
                    @if($bill->file != null)
                    <div class="text-xl">
                        <a download href="{{ $bill->file }}" class="text-red-400"><i class="fi fi-br-file-pdf"></i></a>
                    </div>
                    @else
                    <Link class="!text-md text-blue-600 hover:text-blue-500" modal href="{{ route('de.show-upload', [$bill]) }}">
                        Subir pdf
                        <Link>
                    {{--<x-splade-form :default="['bill_id' => $bill->id]" submit-on-change="file" action="{{ route('de.upload') }}">
                        <x-splade-file name="file"/>
                    </x-splade-form>--}}
                    @endif
                </x-splade-cell>
                 <x-splade-cell acciones as="$bill">
                    <div class="flex justify-around">
                      <Link modal rel="tooltip" title="Ver detalles" href="{{ route('de.items', [$bill])}}"><i class="mr-1 text-xl text-blue-400 hover:text-blue-600 fi fi-br-search"></i></Link>
                      @if($bill->status == 'proccesed')
                       <x-splade-link
                            rel="tooltip" title="Marcar como anulado"
                            confirm-danger="Marcar {{ $bill->serie }}-{{ $bill->number }} como anulado"
                            confirm-text="Estas seguro?"
                            confirm-button="Si, Anular!"
                            cancel-button="No, Cancelar!"
                            preserve-scroll
                            href="{{ route('de.cancel')}}" method="POST" :data="['bill_id' => $bill->id]">
                            <i class="mr-1 text-xl text-red-400 hover:text-red-600 fi fi-br-rectangle-xmark"></i>
                        </x-splade-link>
                      @endif
                    </div>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
@endsection
