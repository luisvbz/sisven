<tbody class="bg-white divide-y divide-gray-200">
    @forelse($table->resource as $itemKey => $item)
        @php $itemPrimaryKey = $table->findPrimaryKey($item) @endphp

        <tr
            @if($table->rowLinks->has($itemKey))
                class="cursor-pointer"
                @click="(event) => table.visit(@js($table->rowLinks->get($itemKey)), @js($table->rowLinkType), event)"
            @endif
            :class="{
                'bg-gray-50': table.striped && @js($itemKey) % 2,
                'hover:bg-gray-100': table.striped,
                'hover:bg-gray-50': !table.striped
            }"
        >
            @if($hasBulkActions = $table->hasBulkActions())
                <td width="64" class="px-6 py-4 text-xs">
                    <input
                        @change="(e) => table.setSelectedItem(@js($itemPrimaryKey), e.target.checked)"
                        :checked="table.itemIsSelected(@js($itemPrimaryKey))"
                        :disabled="table.allItemsFromAllPagesAreSelected"
                        class="border-gray-300 rounded shadow-sm text-primary-600 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:opacity-50"
                        name="table-row-bulk-action"
                        type="checkbox"
                        value="{{ $itemPrimaryKey }}"
                    />
                </td>
            @endif

            @foreach($table->columns() as $column)
                <td
                    v-show="table.columnIsVisible(@js($column->key))"
                    class="whitespace-nowrap text-sm @if($loop->first && $hasBulkActions) pr-6 @else px-6 @endif py-4 @if($column->highlight) text-gray-900 font-medium @else text-gray-500 @endif"
                >
                    @isset(${'spladeTableCell' . $column->keyHash()})
                        {{ ${'spladeTableCell' . $column->keyHash()}($item, $itemKey) }}
                    @else
                        {!! nl2br(e($getColumnDataFromItem($item, $column))) !!}
                    @endisset
                </td>
            @endforeach
        </tr>
    @empty
        <tr>
            <td class="py-6 text-center" colspan="{{ count($table->columns()) }}">
                <div class="text-sm font-medium tracking-wide text-gray-600"> NO HAY DATOS PARA MOSTRAR <i class="fi fi-br-box-open"></i></div>
            </td>
        </tr>
    @endforelse
</tbody>
