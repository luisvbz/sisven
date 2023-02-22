<x-splade-modal size="5xl">
    <div class="py-4">
        <div class="flex pb-2 mb-2 border-b-2 border-gray-200">
            <div class="flex flex-col justify-center flex-grow text-lg">
                @if($movement->type == 'input')
                    <div>Entrada de productos por <span class="text-sm font-semibold uppercase">{{ $movement->input->name }}</span></div>
                @else
                    <div>Salida de productos por <span class="text-sm font-semibold uppercase">{{ $movement->input->name }}</span></div>
                @endif
            </div>
            <div class="flex flex-col items-center justify-center">
                <div class="text-[0.8rem] uppercase font-semibold">Fecha de Registro</div>
                <div>{{ $movement->date }}</div>
            </div>
        </div>
        <div class="relative mt-2 overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-primary-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Producto
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Paquetes
                        </th>
                        <th scope="col" class="px-6 py-3 text-right">
                            Total
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movement->details as $detail)
                    <tr class="bg-white border-b">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowra">
                           {{ $detail->product->full_name }}
                        </th>
                        <td class="px-6 py-4 text-center">
                           {{ $detail->packages."*".$detail->quantity_per_packages }}
                        </td>
                        <td class="px-6 py-4 font-semibold text-right text-success-600">
                           {{ $detail->total }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-splade-modal>
