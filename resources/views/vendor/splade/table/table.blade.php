<SpladeTable {{ $attributes->except('class') }}
    :striped="@js($striped)"
    :columns="@js($table->columns())"
    :search-debounce="@js($searchDebounce)"
    :default-visible-toggleable-columns="@js($table->defaultVisibleToggleableColumns())"
    :items-on-this-page="@js($table->totalOnThisPage())"
    :items-on-all-pages="@js($table->totalOnAllPages())"
    :base-url="@js(request()->url())"
>
    <template #default="{!! $scope !!}">
        <div {{ $attributes->only('class') }} :class="{ 'opacity-50': table.isLoading }">
            @if($hasControls())
                @include('splade::table.controls')
            @endif

            @foreach($table->searchInputs() as $searchInput)
                @includeUnless($searchInput->key === 'global', 'splade::table.search-row')
            @endforeach

            <x-splade-component is="table-wrapper">
                <table class="hidden min-w-full bg-white divide-y divide-gray-200 md:table">
                    @unless($headless)
                        @isset($head)
                            {{ $head }}
                        @else
                            @include('splade::table.head')
                        @endisset
                    @endunless

                    @isset($body)
                        {{ $body }}
                    @else
                        @include('splade::table.body')
                    @endisset
                </table>
                <div class="grid grid-cols-1 gap-4 md:hidden">
                    @forelse($table->resource as $itemKey => $item)
                        @php $itemPrimaryKey = $table->findPrimaryKey($item) @endphp
                        <div class="bg-white rounded-md lg sahdow">
                            @foreach($table->columns() as $column)
                                <div
                                    v-show="table.columnIsVisible(@js($column->key))"
                                    class="relative p-4 py-6 text-sm text-center border-b border-gray-300 @if($column->highlight) text-gray-900 font-medium @endif"
                                >
                                <div class="absolute top-0 left-0 px-2 py-1 text-xs font-semibold text-white rounded-br-lg first:rounded-tl-lg backdrop-blur-sm bg-black/50">
                                    {{ $column->label }}
                                </div>
                                    @isset(${'spladeTableCell' . $column->keyHash()})
                                        {{ ${'spladeTableCell' . $column->keyHash()}($item, $itemKey) }}
                                    @else
                                        {!! nl2br(e($getColumnDataFromItem($item, $column))) !!}
                                    @endisset
                                </div>
                            @endforeach
                        </div>
                        {{-- <div
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
                        </div> --}}
                    @empty
                        <div class="p-6 bg-white rounded-lg shadowlmd">
                            <div class="text-sm font-medium tracking-wide text-center text-gray-600"> NO HAY DATOS PARA MOSTRAR <i class="fi fi-br-box-open"></i></div>
                        </div>
                    @endforelse
                </div>
            </x-splade-component>

            @if($showPaginator())
                {{ $table->resource->links($paginationView, ['table' => $table, 'hasPerPageOptions' => $hasPerPageOptions()]) }}
            @endif
        </div>
    </template>
</SpladeTable>
