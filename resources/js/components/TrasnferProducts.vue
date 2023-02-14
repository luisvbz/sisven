<template>
    <div class="mt-4">
        <label class="block mb-5">
        <div class="flex border border-gray-300 rounded-md shadow-sm">
            <span class="inline-flex items-center px-3 text-gray-500 border border-t-0 border-b-0 border-l-0 border-gray-300 rounded-l-md bg-gray-50">
            <i class="fi fi-br-search"></i>
            </span>
            <input  placeholder="Buscar producto por nombre" type="text"  v-model="query" class="block w-full border-0 rounded-md focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:opacity-50 disabled:bg-gray-50 disabled:cursor-not-allowed">
        </div>
        </label>
        <div class="mb-4" v-for="(product, index)  in filteredItems" :key="product.id">
            <div class="flex items-center justify-between px-4 py-2 bg-gray-100 border border-gray-300 rounded-md">
                <div class="font-semibold grow">{{ product.name }}</div>
                <div class="w-2/6 font-semibold text-primary-500"><span class="text-gray-600">Disponible:</span> {{ product.stock }}</div>
                <input  class="w-1/6 input-text !text-right" type="text" v-model="product.quantity"/>
            </div>
            <div v-if="product.quantity > product.stock" class="px-3 py-1 mt-2 text-sm font-semibold text-white border rounded bg-danger-400 border-danger-600">
                La cantidad a solicitar supera el stock disponible
            </div>

        </div>

    </div>
</template>

<script>
export default {
  props: {
    form: {
        type: Object,
        required: true
    },
  },
  computed: {
    filteredItems() {
      return this.form.products.filter(item => {
         return item.name.toLowerCase().indexOf(this.query.toLowerCase()) > -1
      })
    }
  },
  data() {
    return {
        query: '',

    }
  }
}
</script>
