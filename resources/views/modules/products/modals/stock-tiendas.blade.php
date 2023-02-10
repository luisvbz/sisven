<x-splade-modal>
    <div class="py-3 text-center border-b border-primary-300 mb-4">
        <i class="fi fi-br-box text-primary-600 mt-1 text-lg"></i> Stock Individual del producto: <span class="font-semibold">{{ $product->full_name }}</span>
    </div>
    @if(sizeof($stores) > 0)
        @foreach ($stores as $store)
            <div clas="flex mb-15">
                <div class="flex-grow">{{ $store->code }} - {{ $store->name }}</div>
                <div>{{ $store->stock }}</div>
            </div>
        @endforeach
    @else
        <div class="w-full rounded-lg bg-gray-200 text-gray-500 flex flex-col justify-center items-center" style="padding-top: 30px;padding-bottom: 30px;">
            <div>
                Este producto no tiene stock
            </div>
        </div>
    @endif
</x-splade-modal>
