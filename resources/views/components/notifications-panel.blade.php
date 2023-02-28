<x-splade-modal size="sm" class="p-0 pt-6">
    <div class="mt-6">
        @foreach (auth()->user()->unReadNotifications as $notification)
            @if($notification->type == 'App\Notifications\OrderCreated')
                <div class="border-b border-gray-300">
                    <div class="bg-primary-200 p-1 text-sm font-semibold uppercase px-2">Compra registrada</div>
                    <div class="p-2">
                        <span class="font-semibold">{{ $notification->data['creator']}}</span> ha registrado una nueva compra
                        al proveedor <span class="font-semibold">Proveedor</span> por el monto de <span class="font-semibold">{{ $notification->data['cost']}}</span>. Para mas detalles del compra haz click en el boton
                    </div>
                    <div class="p-2 flex justify-between">
                        <Link href="{{ $notification->data['link'] }}" class="w-full p-1 bg-primary-600 rounded-md text-white text-xs font-semibold text-center">
                            VER COMPRA
                        </Link>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</x-splade-modal>
