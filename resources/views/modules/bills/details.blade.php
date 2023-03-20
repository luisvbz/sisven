<x-splade-modal max-width="3xl">
    <div class="py-4">
        <div class="relative mt-2 overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-primary-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 w-[10%] text-center">
                            CANT
                        </th>
                        <th scope="col" class="px-6 py-3 w-[10%] text-center">
                            MEDIDA
                        </th>
                        <th scope="col" class="px-6 py-3">
                            DESCRIPCION
                        </th>
                        <th scope="col" class="px-6 py-3 text-right w-[10%]">
                            PRECIO
                        </th>
                        <th scope="col" class="px-6 py-3 text-right w-[10%]">
                            TOTAL
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $item)
                    <tr class="bg-white border-b">
                        <td scope="row" class="px-4 py-2 font-medium text-gray-500 whitespace-nowrap text-center">
                            {{ $item->quantity }}
                        </td>
                        <td scope="row" class="px-4 py-2 font-medium text-gray-500 whitespace-nowrap text-center">
                            {{ $item->measure }}
                        </td>
                        <td scope="row" class="px-4 py-2 font-medium text-gray-500 whitespace-nowrap">
                            {{ $item->product->full_name }}
                        </td>
                        <td scope="row" class="px-4 py-2 font-medium text-gray-500 whitespace-nowrap">
                            {{ $item->unit_price }}
                        </td>
                        <td class="px-6 py-4 font-semibold text-right text-success-600">
                             {{ $item->total }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-splade-modal>
