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
                <input @keypress="NumbersOnly" class="w-1/6 input-text !text-right" type="text" v-model="product.quantity"/>
            </div>
            <div v-if="product.quantity > product.stock" class="px-3 py-1 mt-2 text-sm font-semibold text-white border rounded bg-danger-500 border-danger-600">
                La cantidad a solicitar supera el stock disponible
            </div>
        </div>
        <div class="flex justify-between p-5 my-4 rounded shadow-md bg-danger-500" v-if="error.show">
            <div class="font-semibold text-white"><i class="fi fi-br-triangle-warning"></i> {{ error.message }}</div>
            <a class="text-white cursor-pointer" @click="error.show = false"><i class="fi fi-br-user"></i></a>
        </div>
        <div class="flex justify-end">
        <p v-if="form.processing">Submitting the data...</p>
            <button v-else type="button" @click.prevent="checkProducts" class="px-4 py-2 font-bold text-white rounded-md shadow-sm bg-primary-700 hover:bg-primary-500 focus:outline-none focus:shadow-outline">
                <span class="mr-2">Registrar Solicitud</span>
                <i class="leading-7 fi fi-br-disk"></i>
            </button>
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
        error: {
            show: false,
            message: ''
        }

    }
  },
  methods: {
    NumbersOnly(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
        evt.preventDefault();;
      } else {
        return true;
      }
    },
    checkProducts()
    {
        let count = 0;
        this.form.products.forEach(x => {
            if(x.quantity > x.stock) count++;
        })

        if(count > 0)
        {
            this.error.message = "Existen errores en el formulario, por favor revisar"
            this.error.show = true
            return;
        }

        this.form.submit()
    }
  }
}
</script>
