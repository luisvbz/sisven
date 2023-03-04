<x-splade-modal>
    <div class="py-3 mb-4 text-center border-b border-primary-300">
        <i class="mt-1 text-lg fi fi-br-box text-primary-600"></i> Stock Individual del producto: <span class="font-semibold">{{ $product->full_name }}</span>
    </div>
     <div class="relative mt-2 overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 ">
            <thead class="text-xs text-gray-700 uppercase bg-primary-100 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Ubicación
                    </th>
                    <th scope="col" class="px-6 py-3 text-right">
                        Cantidad
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stock as $detail)
                    <tr class="@if($detail->type == 'warehouse') bg-yellow-100 @else bg-white  @endif border-b">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowra">
                        {{ $detail->name }}
                        </th>
                        <td class="px-6 py-4 font-semibold text-right text-success-600">
                        {{ $detail->quantity }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-splade-modal>
