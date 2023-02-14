<x-app-layout>
    <x-slot name="header">
        <x-back-button-title route="/" module="Tiendas" page="Solicitar Productos" />
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <x-splade-form>
                     <p class="text-md text-center font-medium text-gray-600"><i class="fi-br-form"></i> Complete los datos realizar una solicitud de productos</p>
                     <div class="flex bg-primary-100
                     w-3/4 mt-3 border border-primary-300 mx-auto
                     p-4 rounded-md">
                        <div class="w-1/5 text-4xl text-center text-alternative-500 leading-8">
                            <i class="fi fi-br-store-alt"></i>
                        </div>
                        <div>
                            <div>{{ $principal->name }}</div>
                            <div>{{ $principal->address }}</div>
                        </div>
                     </div>
                </x-splade-form>
            </div>
        </div>
    </div>
</x-app-layout>
