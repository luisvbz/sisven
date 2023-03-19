@extends('modules.bills.base')

@section('header')
     Documentos Electrónicos
@endsection

@section('content')
    <div class="py-0">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-splade-table :for="$bills"></x-splade-table>
        </div>
    </div>
@endsection
