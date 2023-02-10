<x-splade-modal>
    <div class="py-3 mb-4 text-center border-b border-primary-300">
        <i class="mt-1 text-lg fi fi-br-box text-primary-600"></i> Stock Individual del producto: <span class="font-semibold">{{ $product->full_name }}</span>
    </div>
    @if(sizeof($stores) > 0)
        @foreach ($stores as $store)
            <div class="flex justify-between p-3 px-5 mb-3 border rounded-md shadow-sm bg-primary-50 border-primary-500 shadow-primar">
                <div class="flex-grow font-semibold">{{ $store->code }} - {{ $store->name }}</div>
                <div>{{ $store->stock }}</div>
            </div>
        @endforeach
    @else
        <div class="flex flex-col items-center justify-center w-full text-gray-500 bg-gray-200 rounded-lg" style="padding-top: 30px;padding-bottom: 30px;">
            <div>
                No se ha registrado stock de este producto
            </div>
        </div>
    @endif
</x-splade-modal>
