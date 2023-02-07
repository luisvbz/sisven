<SpladeInput
    {{ $attributes->only(['v-if', 'v-show', 'class'])->class(['hidden' => $isHidden()]) }}
    :flatpickr="@js($flatpickrOptions())"
    :js-flatpickr-options="{!! $jsFlatpickrOptions !!}"
    v-model="{{ $vueModel() }}"
    #default="inputScope"
>
    <label class="block">
        @includeWhen($label, 'splade::form.label', ['label' => $label])

        @if($attributes->get('icon') == '')
            <div class="flex border border-gray-300 rounded-md shadow-sm">
                @if($prepend)
                    <span :class="{ 'opacity-50': inputScope.disabled && @json(!$alwaysEnablePrepend) }" class="inline-flex items-center px-3 text-gray-500 border border-t-0 border-b-0 border-l-0 border-gray-300 rounded-l-md bg-gray-50">
                        {!! $prepend !!}
                    </span>
                @endif
                <input {{ $attributes->except(['v-if', 'v-show', 'class'])->class([
                    'block w-full border-0 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:opacity-50 disabled:bg-gray-50 disabled:cursor-not-allowed',
                    'rounded-md' => !$append && !$prepend,
                    'min-w-0 flex-1 rounded-none' => $append || $prepend,
                    'rounded-l-md' => $append && !$prepend,
                    'rounded-r-md' => !$append && $prepend,
                ])->merge([
                    'name' => $name,
                    'type' => $type,
                    'v-model' => $flatpickrOptions() ? null : $vueModel(),
                    'data-validation-key' => $validationKey(),
                ]) }}
                />

                @if($append)
                    <span :class="{ 'opacity-50': inputScope.disabled && @json(!$alwaysEnableAppend) }" class="inline-flex items-center px-3 text-gray-500 border border-t-0 border-b-0 border-r-0 border-gray-300 rounded-r-md bg-gray-50">
                        {!! $append !!}
                    </span>
                @endif
            </div>
         @else
         <div class="flex border border-gray-300 rounded-md shadow-sm">
            @if($prepend)
                <span :class="{ 'opacity-50': inputScope.disabled && @json(!$alwaysEnablePrepend) }" class="inline-flex items-center px-3 text-gray-500 border border-t-0 border-b-0 border-l-0 border-gray-300 rounded-l-md bg-gray-50">
                    {!! $prepend !!}
                </span>
            @endif
            <span :class="{ 'opacity-50': inputScope.disabled && @json(!$alwaysEnablePrepend) }" class="inline-flex items-center px-3 text-gray-500 border border-t-0 border-b-0 border-l-0 border-gray-300 rounded-l-md bg-gray-50">
                <i class="fi fi-br-{{$attributes->get('icon')}}"></i>
            </span>
            <input {{ $attributes->except(['v-if', 'v-show', 'class'])->class([
                'block w-full border-0 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:opacity-50 disabled:bg-gray-50 disabled:cursor-not-allowed',
                'rounded-md' => !$append && !$prepend,
                'min-w-0 flex-1 rounded-none' => $append || $prepend,
                'rounded-l-md' => $append && !$prepend,
                'rounded-r-md' => !$append && $prepend,
            ])->merge([
                'name' => $name,
                'type' => $type,
                'v-model' => $flatpickrOptions() ? null : $vueModel(),
                'data-validation-key' => $validationKey(),
            ]) }}
            />

            @if($append)
                <span :class="{ 'opacity-50': inputScope.disabled && @json(!$alwaysEnableAppend) }" class="inline-flex items-center px-3 text-gray-500 border border-t-0 border-b-0 border-r-0 border-gray-300 rounded-r-md bg-gray-50">
                    {!! $append !!}
                </span>
            @endif
        </div>

        @endif
    </label>

    @include('splade::form.help', ['help' => $help])
    @includeWhen($showErrors, 'splade::form.error', ['name' => $validationKey()])
</SpladeInput>
