<x-splade-modal size="lg">
    <div class="flex space-x-3 py-4 border-b border-gray-300 mb-4">
        <div class="flex flex-col bg-amber-200 rounded border border-amber-300 w-1/2 p-2">
            <div class="text-sm uppercase font-medium border-b border-amber-400 text-amber-700 pb-1 mb-1">Origen</div>
            <div class="flex space-x-2">
                <div class="text-xl text-amber-700">
                    <i class="fi fi-br-inbox-out"></i>
                </div>
                <div class="text-xl text-amber-700">
                    {{ $transfer->warehouse->name }}
                </div>
            </div>
        </div>
        <div class="flex flex-col bg-success-200 rounded border border-success-300 w-1/2 p-2">
            <div class="text-sm uppercase font-medium border-b border-success-400 text-success-700 pb-1 mb-1">Destino</div>
            <div class="flex space-x-2">
                <div class="text-xl text-success-700">
                    <i class="fi fi-br-inbox-in"></i>
                </div>
                <div class="text-xl text-success-700">
                    {{ $transfer->store->name }}
                </div>
            </div>
        </div>
    </div>
    <div class="bg-gray-100 rounded border border-gray-300 p-2 mb-2">
        <p class="text-sm">Requerido por: <span class="font-semibold">{{ $transfer->requested->name }}</span></p>
    </div>
    <div class="relative mt-2 overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-primary-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Producto
                        </th>
                        <th scope="col" class="px-6 py-3 text-right">
                            Total
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transfer->products as $detail)
                    <tr class="bg-white border-b">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowra">
                           {{ $detail->full_name }}
                        </th>
                        <td class="px-6 py-4 font-semibold text-right text-success-600">
                           {{ $detail->pivot->quantity }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</x-splade-modal>
