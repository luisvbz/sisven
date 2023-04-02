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
                        <p class="font-medium text-gray-400 uppercase">NO SE HAN AGREGADO PRODUCTOS EN LA COMPRA</p>
                    </div>
                    <div v-for="(product, index) in form.products" :key="'p'+product.id">
                        <div
                        class="flex space-x-4"
                        >
                             <div class="w-20">
                                <label class="block mb-1 text-sm font-medium text-gray-900">Cant.</label>
                                <input type="number" v-model="product.quantity_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">Tipo</label>
                                <select v-model="product.type_sale" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option v-for="type in form.types" :key="Math.random()" :value="type.id">{{ type.alias }}</option>
                                </select>
                            </div>
                            <div class="w-[50%]">
                                <label class="block mb-1 text-sm font-medium text-gray-900">Producto.</label>
                                <input type="text" readonly :value="product.full_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div class="w-20">
                                <CurrencyInput
                                    :disabled="form.blocked"
                                    label="P. Unit"
                                    v-model="product.unit_price"
                                    :icon="false"
                                    :options="{ currency: 'PEN' }"
                                    />
                            </div>
                            <div class="w-[10%]">
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
                <!-- /lista de productos -->
            </div>
            <div class="w-2/6 ">
                <div class="sticky flex flex-col p-4 space-y-2 bg-white border border-gray-300 rounded-md shadow-md top-8 ">
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
                            autocomplete="off"
                            class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-primary-300 dark:focus:border-primary-300" placeholder="Buscar por DNI, RUC, nombre...">
                            <div class="bg-white absolute top-10 left-0 w-full rounded-md border border-gray-300 max-h-[250px] overflow-y-auto" v-if="clients.show">
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
                    <div class="flex justify-between p-1 pb-2 mb-4 text-lg border-b border-gray-300">
                        <div class="font-medium">Total</div>
                        <div>S/. {{ price(totalSale) }}</div>
                    </div>
                    <slot name="extend"></slot>
                    <div v-if="form.payment_methods.length > 0" class="space-y-1">
                        <div class="py-1 text-sm font-medium text-center uppercase bg-gray-200 rounded-md">Pagos agregados</div>
                        <div v-for="(pm,index) in form.payment_methods" :key="Math.random()"
                            class="flex p-2 bg-gray-100 border border-gray-300 rounded ">
                            <div class="flex flex-col items-center justify-center mr-2">
                                <img v-if="pm.type_id == 1" src="/images/money.svg" class="w-6"/>
                                <img v-else-if="pm.type_id == 2" src="/images/yape.png" class="w-6"/>
                                <img v-else-if="pm.type_id == 3" src="/images/bank.svg" class="w-6"/>
                            </div>
                            <div class="flex-grow">
                                <template v-if="pm.type_id > 1">
                                    <div class="text-sm font-semibold">{{ pm.titular }}</div>
                                    <div class="text-xs">{{ pm.operation_date }}</div>
                                    <div v-if="pm.type_id == 3" class="text-xs">{{ pm.operation }}</div>
                                </template>
                                <template v-else>
                                    <div class="font-semibold text-md">Efectivo</div>
                                </template>
                            </div>
                            <div class="flex flex-col items-center justify-center mr-2">
                                <div>S/ <span class="font-semibold">{{ pm.amount}}</span></div>
                            </div>
                            <div class="flex flex-col items-center justify-center">
                                <i @click="form.payment_methods.splice(index,1)" class="text-lg cursor-pointer fi fi-br-trash text-danger-500 hover:text-danger-600"></i>
                            </div>
                        </div>
                    </div>
                    <a @click="form.total == 0 ? false : openModal()" class="cursor-pointer">
                        <div class="flex items-center justify-center px-2 py-1 text-sm font-medium uppercase border rounded-md bg-primary-100 border-primary-300 hover:bg-primary-200">
                            <span>Agregar metodo de pago</span> <i class="mt-2 ml-2 fi fi-br-credit-card"></i>
                        </div>
                    </a>
                    <a  @click="showAuthorization = true" class="cursor-pointer">
                        <div class="flex items-center justify-center px-2 py-1 text-sm font-medium uppercase border rounded-md bg-success-100 border-success-300 hover:bg-success-300">
                            <span>Autorizar </span> <i class="mt-2 ml-2 fi fi-br-lock"></i>
                        </div>
                    </a>
                    <div>
                        <button v-if="!form.processing" @click="realizarVenta" type="button" class="w-full px-5 py-2 mb-2 mr-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">FINALIZAR VENTA</button>
                        <div v-else class="w-full px-5 py-2 mb-2 mr-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg opacity-40 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">PROCENSANDO</div>
                    </div>
                </div>
            </div>
        </div>

        <div  tabindex="-1"  :class="['bg-black/50  backdrop-blur-sm fixed top-0 left-0 right-0 z-50 flex justify-center flex-col items-center w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full', {'hidden': !showModal}]">
            <div class="relative w-full h-full max-w-md md:h-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Agregar pago
                        </h3>
                        <button type="button" @click="closeModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="staticModal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-2">
                        <div class="mb-1">
                            <label for="type" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Selecione el tipo</label>
                                <select v-model="data.type_id" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 ">
                                <option selected value="">Sleeccione el tipo</option>
                                <option v-for="type in types" :key="type.alias" :value="type.id" v-text="type.name"></option>
                            </select>
                        </div>
                        <template v-if="data.type_id != 1 && data.type_id != ''">
                            <div class="mb-1">
                                <label for="titular" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Nombre o Titular</label>
                                <input type="text" v-model="data.titular" id="titular" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                            </div>
                            <div class="mb-1" v-if="data.type_id == '3'">
                                <label for="operation" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Número de operación</label>
                                <input type="text" v-model="data.operation" id="operation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                            </div>
                            <div class="mb-1" v-if="data.type_id == '3'">
                                <label for="back" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Banco</label>
                                <input type="text" v-model="data.back" id="back" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                            </div>
                            <div class="mb-1">
                                <label for="operation_date" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Fecha de Operación</label>
                                <input type="date" v-model="data.operation_date" id="operoperation_dateation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                            </div>
                        </template>
                        <div>
                            <CurrencyInput
                                        label="Monto pagado"
                                        v-model="data.amount"
                                        :icon="false"
                                        :options="{ currency: 'PEN' }"
                                        />
                        </div>

                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="button" @click="agregarPago" class="text-white w-full bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Agreagar Pago</button>

                    </div>
                </div>
            </div>
        </div>
        <div  tabindex="-1"  :class="['bg-black/50  backdrop-blur-sm fixed top-0 left-0 right-0 z-50 flex justify-center flex-col items-center w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full', {'hidden': !showAuthorization}]">
            <div class="relative w-full h-full max-w-md md:h-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Autorizar cambios de precio en la venta
                        </h3>
                        <button type="button" @click="closeAuthorizacion" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="staticModal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-2">
                        <div class="mb-1">
                            <label for="titular" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Usuario</label>
                            <input type="text" v-model="autorizacion.usuario" id="titular" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                        </div>
                        <div class="mb-1">
                            <label for="operation" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Clave</label>
                            <input type="password" v-model="autorizacion.password" id="operation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                        </div>

                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="button" @click="autorizar" class="text-white w-full bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Agreagar Pago</button>

                    </div>
                </div>
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
    types: {
        type: Object,
        required: true
    }
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
        },
        showModal: false,
        showAuthorization: false,
        data: {
            type_id : '',
            titular: '',
            operation: '',
            operation_date: '',
            bank: '',
            amount: 0
        },
        autorizacion: {
            usuario: '',
            password: ''
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
    'form.store_id' ()
    {
        this.form.products = [];
    }
  },
  computed: {
    totalSale()
    {
        let total = 0;

        this.form.products.forEach(element => {
            total = total + element.total_price;
        });

        this.form.total = total;
        return total;
    }
  },
  methods: {
    addClient()
    {
        console.log(this.$splade.visit)
    },
    closeAuthorizacion()
    {
        this.autorizacion.usuario = '';
        this.autorizacion.password = '';
        this.showAuthorization = false;
    },
    autorizar()
    {
         if(this.autorizacion.usuario == '') {
             this.$toast.warning("Debe escribir el usuario", {
                    position: 'top',
                    duration: 3000
                })

                return;
        }

        if(this.autorizacion.password == '') {
             this.$toast.warning("Debe escribir la contraseña", {
                    position: 'top',
                    duration: 3000
                })

                return;
        }

        axios.post(`/api/sales/autorizar`, this.autorizacion).then(rs => {

            if(rs.data.autorizar) {
                this.form.blocked = false;
                this.closeAuthorizacion();
                this.$toast.success("Autorización exitosa", {
                    position: 'top',
                    duration: 3000
                })
            }else {
                this.$toast.warning(rs.data.msj, {
                    position: 'top',
                    duration: 3000
                })
            }
        })
    },
    openModal()
    {
        let total = _.sumBy(this.form.payment_methods, function(o) {return o.amount})

        if(total == this.form.total) {
             this.$toast.warning("No puedes agregar mas pagos a esta venta", {
                    position: 'top',
                    duration: 3000
                })

                return;
        }
        this.showModal = true;
    },
    closeModal()
    {
        this.data = {
            type_id : '',
            titular: '',
            operation: '',
            operation_date: '',
            bank: '',
            amount: 0
        };

        this.showModal = false;
    },
    agregarPago ()
    {
        if(this.data.type_id == 2) {

            let errors = 0;
            if(this.data.titular == '') {
                this.$toast.warning("Debes indicar el nombre del Yape", {
                    position: 'top',
                    duration: 3000
                })

                errors++;
            }

            if(this.data.operation_date == '') {
                this.$toast.warning("Debes indicar la fecha del Yape", {
                    position: 'top',
                    duration: 3000
                })

                errors++;
            }

            if(errors) return;
        }

         if(this.data.type_id == 3) {

            let errors = 0;
            if(this.data.titular == '') {
                this.$toast.warning("Debes indicar el titular de la cuenta", {
                    position: 'top',
                    duration: 3000
                })

                errors++;
            }

            if(this.data.operation == '') {
                this.$toast.warning("Debes indicar el numero de operación", {
                    position: 'top',
                    duration: 3000
                })

                errors++;
            }

            if(this.data.operation_date == '') {
                this.$toast.warning("Debes indicar la fecha del Deposito o Transferencia", {
                    position: 'top',
                    duration: 3000
                })

                errors++;
            }

            if(errors) return;
        }

        if(this.data.amount == 0) {
             this.$toast.warning("Debes indicar el monto", {
                    position: 'top',
                    duration: 3000
                })
                return;
        }

        let total = _.sumBy(this.form.payment_methods, function(o) {return o.amount})
        let totalNext = total + this.data.amount;

        if(totalNext > this.form.total) {
            this.data.amount = this.form.total - total;
        }

        this.form.payment_methods.push(this.data);
        this.closeModal();
    },
    getProductsByStore(storeId)
    {   this.products.show = true;
        this.products.loading = true;
        this.products.data = [];
        axios.get(`/api/sales/store/${storeId}/products?query=${this.queryProduct}`).then(rs => {
             this.products.data = rs.data.products
        }).catch(e => {
            console.log(e)
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
        console.log(exists)
        if(exists == undefined) {
            let item = {
                product_id: product.id,
                full_name: product.full_name,
                type_sale: 1,
                quantity_type: 0,
                quantity_total: 0,
                unit_price: product.price,
                total_price: 0,
                stock: product.stock,
                omit: false
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
    },
    getClient()
    {
        this.clients.show = true;
        this.clients.loading = true;
        this.clients.data = [];
        axios.get(`/api/sales/clients?query=${this.queryClient}`).then(rs => {
            this.clients.data = rs.data.clients
        }).catch(e => {
            console.log(e)
        }).finally(() => {
            this.clients.loading = false;
        })
    },
    totalByProduct(product, index)
    {
        let total = 0;
        let quantity = 0;
        product.omit = false;
        if(product.quantity_type < 0) {
            this.form.products[index].quantity_type = 0;
        }
        if(product.type_sale == 1) {
            total = product.unit_price*(product.quantity_type*12);
            quantity = product.quantity_type*12
        }else if(product.type_sale == 2){
            total = product.unit_price*(product.quantity_type*6);
            quantity = product.quantity_type*6
        }else if(product.type_sale == 3){
            total = product.unit_price*(product.quantity_type*3);
            quantity = product.quantity_type*3
        }else {
            total = product.unit_price*product.quantity_type;
            quantity = product.quantity_type
        }
        if(quantity > product.stock) {
            this.form.products[index].omit = true;
            this.form.products[index].total_price = 0;
            this.form.products[index].quantity_total = quantity;
        }else {
            this.form.products[index].total_price = total;
            this.form.products[index].quantity_total = quantity;
        }
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

        if(this.form.payment_methods.length == 0) {
            this.$toast.error("Debe agregar los <b>PAGOS</b>", {
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

        let total = _.sumBy(this.form.payment_methods, function(o) {return o.amount})

        if(total < this.form.total) {
            this.$toast.error("El total de pagos debe ser igual al monto de la venta", {
                position: 'top',
                duration: 5000
            })
            errors++;
        }



        if(errors > 0) return;
        this.form.submit()
    }
  },
}
</script>
