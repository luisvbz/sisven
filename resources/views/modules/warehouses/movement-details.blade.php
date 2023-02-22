<x-splade-modal size="5xl">
    <div class="py-4">
        @foreach ($movement->details as $detail)
            <div class="flex px-3 py-2 mb-2 text-sm border rounded bg-primary-100 border-primary-400">
                <div class="flex-grow font-semibold">{{ $detail->product->full_name }}</div>
                <div class="px-3">{{ $detail->packages."*".$detail->quantity_per_packages }}</div>
                <div class="font-bold text-success-600 !text-md">{{ $detail->total }}</div>
            </div>
        @endforeach
    </div>
</x-splade-modal>
