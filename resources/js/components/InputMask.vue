<template>
<label class="block">
    <span class="block mb-1 font-sans text-sm font-medium text-gray-700">{{ label }}</span>
    <div class="flex border border-gray-300 rounded-md shadow-sm">
        <span class="inline-flex items-center px-3 text-gray-500 border border-t-0 border-b-0 border-l-0 border-gray-300 rounded-l-md bg-gray-50"><i :class="`fi fi-br-${icon}`"></i></span>
         <input
            :data-maska="mask"
            type="text"
            class="block w-full border-0 rounded-md focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:opacity-50 disabled:bg-gray-50 disabled:cursor-not-allowed"
        />
    </div>
</label>
</template>

<script>
import { MaskInput } from "maska"

export default {
  name: 'InputMask',
  props: {
    modelValue: String, // Vue 2: value
    label: String,
    mask: String,
    icon: {
        type:String,
        default: 'info'
    }
  },
  mounted()
  {
    new MaskInput("[data-maska]")
  }
}
</script>
