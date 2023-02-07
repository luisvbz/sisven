@if($name)<p class="p-1 px-2 text-xs font-bold text-white bg-danger-500 border rounded-lg text-centered mt-1" v-if="form.hasError(@js($name))" v-bind="form.$errorAttributes(@js($name))" />@endif
