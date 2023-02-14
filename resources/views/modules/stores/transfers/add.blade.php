<x-app-layout>
    <x-slot name="header">
        <x-back-button-title route="/" module="Tiendas" page="Solicitar Productos" />
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <x-splade-form :default="['products' => $products, 'canSend' => true]">
                     <p class="font-medium text-center text-gray-600 text-md"><i class="fi-br-form"></i> Solicitar productos a la tienda principal</p>
                     <div class="flex w-3/4 p-4 pb-4 mx-auto mt-3 mb-4 border rounded-md bg-primary-100 border-primary-300">
                        <div class="flex flex-col items-center justify-center w-1/5 text-4xl leading-8 text-center text-alternative-500">
                            <i class="fi fi-br-store-alt"></i>
                        </div>
                        <div>
                            <div class="font-semibold">{{ $principal->name }}</div>
                            <div class="text-sm">{{ $principal->address }}</div>
                        </div>
                     </div>
                     <x-splade-select name="destination" label="Seleccione la tienda de destino"
                            placeholder="Seleccione una de las tiendas"
                            :options="$others"
                             option-label="name"
                             choices
                             option-value="id" />
                  <p class="mt-3 font-medium text-gray-600 text-md"><i class="fi-br-form"></i> Seleccione los productos que desea solicitar</p>
                  <transfer-products :form="form"/>
                </x-splade-form>
            </div>
        </div>
    </div>
</x-app-layout>
