@extends('modules.clients.base')

@section('header')
     Clientes
@endsection

@section('content')
    <div class="py-0">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-splade-rehydrate on="client-saved">
             <x-splade-table :for="$clients"/>
            </x-splade-rehydrate>
        </div>
    </div>
@endsection
