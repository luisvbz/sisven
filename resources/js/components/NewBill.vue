<template>
    <div>
        <div v-if="error.show" class="flex p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
            <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Error!</span> {{ error.message}}
            </div>
        </div>
        <!-- panel de ventas -->
        <div class="flex space-x-3">
                    <div class="w-2/6">
                <div class="flex flex-col p-4 space-y-2 bg-white border border-gray-300 rounded-md shadow-md ">
                    <div>
                        <div class="flex justify-between">
                            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-onl">Cliente</label>
                            <Link class="text-sm font-medium text-blue-500 uppercase hover:text-blue-700" href="/clientes/nuevo" slideover>Agregar Nuevo</Link>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="search"
                            v-model="queryClient"
                            id="default-search"
                            class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-primary-300 dark:focus:border-primary-300" placeholder="Buscar por DNI, RUC, nombre...">
                            <div class="bg-white z-10 absolute top-10 left-0 w-full rounded-md border border-gray-300 max-h-[250px] overflow-y-auto" v-if="clients.show">
                                <div v-if="clients.loading" class="flex items-center justify-center p-4 text-primary-500">
                                    Buscando Cliente...
                                </div>
                                <ul v-if="clients.data.length > 0">
                                    <li @click="setClient(client)" v-for="client in clients.data" :key="client.document_number" class="hover:bg-primary-400 px-1 py-[0.1rem] text-gray-600 hover:text-white cursor-pointer">
                                        <div class="text-sm ">{{ client.name }}</div>
                                        <div class="text-xs font-medium"><span class="uppercase">{{ client.document_type }}</span>: {{ client.document_number }}</div>
                                    </li>
                                </ul>
                                <div v-if="clients.data.length == 0 && queryClient != ''" class="flex flex-col items-center justify-center p-4 text-primary-500">
                                    <p class="mb-2">No se ha conseguido el cliente..</p> <Link class="text-sm font-medium text-blue-500 uppercase hover:text-blue-700" href="/clientes/nuevo" slideover>Agregar Nuevo</Link>
                                </div>
                            </div>
                        </div>
                        <div class="flex p-2 mt-2 bg-gray-100 border border-gray-300 rounded-md" v-if="client.selected">
                            <div>
                                <svg class="w-12 h-12 text-primary-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="flex flex-col justify-center ml-1 grow">
                                <div class="text-base">{{ client.name }}</div>
                                <div class="text-xs font-medium"><span class="uppercase">{{ client.document_type }}</span>: {{ client.document_number }}</div>
                            </div>
                            <div class="flex flex-col justify-center">
                                <a @click="removeClient"><svg class="w-8 h-8 text-red-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <line x1="4" y1="7" x2="20" y2="7" />  <line x1="10" y1="11" x2="10" y2="17" />  <line x1="14" y1="11" x2="14" y2="17" />  <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />  <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a>
                            </div>
                        </div>
                    </div>
                    <slot name="extend"></slot>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-900">Total Gravada.</label>
                        <input type="text" readonly :value="form.total_gravada" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="flex items-center mb-4">
                        <input v-model="form.igv" id="default-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <label for="default-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tiene IGV</label>
                    </div>
                    <div v-if="form.igv">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Total IGV(18%).</label>
                        <input type="text" readonly :value="form.total_igv" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-900">Total</label>
                        <input type="text" readonly :value="form.total" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>

                    <div>
                        <button v-if="!form.processing" @click="realizarVenta" type="button" class="w-full px-5 py-2 mb-2 mr-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">FINALIZAR</button>
                        <div v-else class="w-full px-5 py-2 mb-2 mr-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg opacity-40 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">PROCENSANDO</div>
                    </div>
                </div>
            </div>
            <div class="w-4/6">
                <!-- buscador de productos -->
                <div class="pb-3 mb-4 border-b border-gray-300">
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-onl">Buscador de productos</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="search"
                         id="default-search"
                         autocomplete="off"
                         v-model="queryProduct"
                        class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-primary-300 dark:focus:border-primary-300" placeholder="Buscar producto">
                        <div class="bg-white shadow-xl absolute top-10 left-0 w-full rounded-md border border-gray-300 max-h-[250px] overflow-y-auto" v-if="products.show">
                            <div v-if="products.loading" class="flex items-center justify-center p-4 text-primary-500">
                                Buscando productos...
                            </div>
                            <ul v-if="products.data.length > 0">
                                <li @click="addProduct(product)" v-for="product in products.data" :key="product.id" class="hover:bg-primary-400 px-1 py-[0.1rem] text-gray-600 hover:text-white cursor-pointer">
                                    <div class="flex flex-col p-1">
                                        <div class="text-md">{{ product.full_name }} <span class="font-medium">S/. {{ parseFloat(product.price).toFixed(2) }}</span></div>
                                        <div class="text-xs font-medium"><span>STOCK: </span>{{ product.stock}} - ({{product.measure}})</div>
                                    </div>
                                </li>
                            </ul>
                            <div v-if="products.data.length == 0 && queryProduct != ''" class="flex items-center justify-center p-4 text-primary-500">
                                No se ha conseguido el producto..
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /buscador de productos -->
                <!-- lista de productos -->
                <div class="flex flex-col p-4 space-y-2 bg-white border border-gray-300 divide-y-2 rounded-md shadow-md">
                    <div v-if="form.products.length == 0" class="flex items-center justify-center p-12">
                        <p class="font-medium text-gray-400 uppercase">NO SE HAN AGREGADO PRODUCTOS A ESTE DOCUMENTO</p>
                    </div>
                    <div v-for="(product, index) in form.products" :key="'p'+product.id">
                        <div
                        class="flex space-x-4"
                        >
                             <div class="w-20">
                                <label class="block mb-1 text-sm font-medium text-gray-900">Cant.</label>
                                <input type="number" v-model="product.cant" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">Tipo</label>
                                <select v-model="product.measure" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="DOC">DOCENA</option>
                                    <option value="UNID">UNIDAD</option>
                                </select>
                            </div>
                            <div class="w-[35%]">
                                <label class="block mb-1 text-sm font-medium text-gray-900">Producto.</label>
                                <input type="text" readonly :value="product.full_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div class="w-[15%]">
                                <CurrencyInput
                                    label="P. Unit"
                                    v-model="product.unit_price"
                                    :icon="false"
                                    :options="{ currency: 'PEN', precision: 6 }"
                                    />
                            </div>
                            <div class="w-[15%]">
                                <label class="block mb-1 text-sm font-medium text-gray-900">Total.</label>
                                <input type="text" readonly :value="price(totalByProduct(product, index))" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-right">
                            </div>
                            <div class="flex flex-col justify-center">
                            <a class="mt-6 cursor-pointer" @click="removeProduct(index)"><svg class="w-8 h-8 text-red-500 hover:text-red-600"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <line x1="4" y1="7" x2="20" y2="7" />  <line x1="10" y1="11" x2="10" y2="17" />  <line x1="14" y1="11" x2="14" y2="17" />  <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />  <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a>
                            </div>
                        </div>
                        <div v-if="product.omit" class="p-1 px-2 my-2 text-sm text-red-900 bg-red-300 border rounded-md">
                            Esta seleccionando <strong>{{product.quantity_total}}</strong> solo tiene disponible <strong>{{product.stock}}</strong> en stock, este item será omitido
                        </div>
                    </div>
                </div>
                <slot name="errors"></slot>
                <!-- /lista de productos -->
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import CurrencyInput from './CurrencyInput.vue';
import _ from 'lodash'
export default {
  props: {
    form: {
        type: Object,
        required: true
    },
  },
  components: {
    CurrencyInput
  },
  /* computed: {
    filteredItems() {
      return this.form.products.filter(item => {
         return item.name.toLowerCase().indexOf(this.query.toLowerCase()) > -1
      })
    }
  }, */
  mounted()
  {
    this.$splade.on('client-saved', function(event) {
        this.queryClient = '';
    });
  },
  data() {
    return {
        queryClient: '',
        queryProduct: '',
        clients: {show: false, loading: false, data: []},
        client: {selected: false, id: null, name: null, document_number: null, document_type: null},
        loadingProducts: false,
        products: {show: false, loading: false, data: []},
        error: {
            show: false,
            message: ''
        }

    }
  },
  watch:
  {
    queryClient () {
        if(this.queryClient.length > 3) {
            this.getClient();
        }else if(this.queryClient.length == 0) {
            this.clients.show = false
            this.clients.data = []
            this.clients.loading = false
        }
    },
    queryProduct () {
        if(this.queryProduct.length > 3) {
            this.getProductsByStore(this.form.store_id);
        }else if(this.queryClient.length == 0) {
            this.products.show = false
            this.products.data = []
            this.products.loading = false
        }
    },
  },
  methods: {
    getProductsByStore(storeId)
    {   this.products.show = true;
        this.products.loading = true;
        this.products.data = [];
        axios.get(`/api/bills/products?query=${this.queryProduct}`).then(rs => {
             this.products.data = rs.data.products
        }).catch(e => {
            //console.log(e)
        }).finally(() => {
             this.products.loading = false
        })
    },
    setClient(client)
    {
        this.client.id = client.id
        this.client.name = client.name
        this.client.document_number = client.document_number
        this.client.document_type = client.document_type
        this.client.selected = true
        this.form.client_id = client.id
        this.queryClient = '';

        this.clients.show = false;
        this.clients.loading = false;
        this.clients.data = [];
    },
    addProduct(product)
    {
        let exists = _.find(this.form.products, (o) => o.product_id == product.id);
        //console.log(exists)
        if(exists == undefined) {
            let item = {
                product_id: product.id,
                full_name: product.full_name,
                measure: 'UNID',
                cant: 0,
                unit_price: product.price,
                total_price: 0,
            }

            this.form.products.push(item)
            this.products.show = false;
            this.products.data = [];
            this.queryProduct = '';
        }else {
            this.$toast.warning("Ya tienes agregado este producto", {
                position: 'top',
                duration: 3000
            })
        }

    },
    removeClient()
    {
        this.client.id = null
        this.client.name = null
        this.client.document_number = null
        this.client.document_type = null
        this.client.selected = false
        this.form.client_id = null
        this.queryClient = '';
    },
    removeProduct(index)
    {
        this.form.products.splice(index, 1)
        this.totalSale()
    },
    getClient()
    {
        this.clients.show = true;
        this.clients.loading = true;
        this.clients.data = [];
        axios.get(`/api/bills/clients?query=${this.queryClient}`).then(rs => {
            this.clients.data = rs.data.clients
        }).catch(e => {
            //console.log(e)
        }).finally(() => {
            this.clients.loading = false;
        })
    },
    totalByProduct(product, index)
    {
        let total = 0;

         if(product.cant < 0) {
            this.form.products[index].cant = 0;
        }

        total = product.cant * product.unit_price;
        this.form.products[index].total_price = total;


        this.totalSale()
        return total;

    },
    NumbersOnly(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
        evt.preventDefault();;
      } else {
        return true;
      }
    },
    price(value) {
        let val = (value/1).toFixed(2).replace(',', '.')
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    },
    totalSale()
    {
        let total = 0;

        if(this.form.products.length > 0) {

            this.form.products.forEach(element => {
                total = total + element.total_price;
            });

            let total_igv = this.form.igv ? (total * 0.18) : 0;
            let total_monto = total + total_igv

            this.form.total_gravada = total.toFixed(2);
            this.form.total = total_monto.toFixed(2);
            this.form.total_igv = total_igv.toFixed(2);

        }else {
            this.form.total = 0;
            this.form.total_igv = 0;
        }
    },
    realizarVenta()
    {
        let errors = 0;
        if(this.form.client_id == null) {
            this.$toast.error("Debe seleccionar el <b>CLIENTE</b>", {
                position: 'top',
                duration: 5000
            })
            errors++;
        }

        if(this.form.products.length == 0) {
            this.$toast.error("Debe seleccionar los <b>PRODUCTOS</b>", {
                position: 'top',
                duration: 5000
            })
            errors++;
        }

        this.form.products.forEach(x => {
                if(x.quantity_type == 0) {
                this.$toast.error(`No has seleccionado la cantidad del producto <b>${x.full_name}</b>`, {
                    position: 'top',
                    duration: 5000
                })

                 errors++;
            }
        })

        if(errors > 0) return;
        this.form.submit()
    }
  },
}
</script>
