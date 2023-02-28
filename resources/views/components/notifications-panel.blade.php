<x-splade-modal size="sm" class="p-0 pt-6">
        @foreach (auth()->user()->unReadNotifications as $notification)
            @if($notification->type == 'App\Notifications\OrderCreated')
                <div class="border-b border-gray-300">
                    <div class="p-1 px-2 text-sm font-semibold uppercase bg-primary-200">Compra registrada</div>
                    <div class="p-2">
                        <span class="font-semibold">{{ $notification->data['creator']}}</span> ha registrado una nueva compra
                        al proveedor <span class="font-semibold">Proveedor</span> por el monto de <span class="font-semibold">{{ $notification->data['cost']}}</span>. Para mas detalles del compra haz click en el boton
                    </div>
                    <div class="flex justify-between p-2">
                        <Link href="{{ $notification->data['link'] }}" class="w-full p-1 text-xs font-semibold text-center text-white rounded-md bg-primary-600">
                            VER COMPRA
                        </Link>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</x-splade-modal>
