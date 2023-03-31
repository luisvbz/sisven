<template>
<label class="block">
    <span class="block mb-1 font-sans text-sm font-medium text-gray-700">{{ label }}</span>
    <div class="flex border border-gray-300 rounded-md shadow-sm">
        <span v-if="icon" class="inline-flex items-center px-3 text-gray-500 border border-t-0 border-b-0 border-l-0 border-gray-300 rounded-l-md bg-gray-50"><i class="fi fi-br-dollar"></i></span>
         <input
            :readonly="disabled"
            :disabled="disabled"
            ref="inputRef"
            type="text"
            class="block w-full border-0 rounded-md focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:opacity-50 disabled:bg-gray-50 disabled:cursor-not-allowed"
        />
    </div>
</label>


</template>

<script>
import { useCurrencyInput } from 'vue-currency-input'

export default {
  name: 'CurrencyInput',
  props: {
    modelValue:Number,
    options: Object,
    label: String,
    disabled: {
        type: Boolean,
        default: false
    },
    icon: {
        type: Boolean,
        default: true
    }
  },
  setup(props) {
    const { inputRef, setOptions, setValue  } = useCurrencyInput(props.options)

    return { inputRef }
  }
}
</script>
