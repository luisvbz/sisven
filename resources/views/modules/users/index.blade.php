<x-app-layout>
    <x-slot name="header">
        <x-back-button-title route="/" module="Usuarios" />
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-3 mb-3 bg-white shadow-sm sm:rounded-lg">
                <Link modal href="{{ route('us.add') }}" class="button-indigo"><span>Agregar</span> <i class="ml-2 fi fi-br-user-add"></i></Link>
            </div>
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                        <x-splade-table :for="$users">
                            @cell('Rol', $user)
                            <span class="bg-indigo-200 text-indigo-800 text-xs font-medium mr-2 px-2.5 py-2 rounded  border border-indigo-400">{{ $user->role_name }}</span>
                            @endcell
                            @cell('Actions')
                                <i class="mr-1 text-xl text-green-400 hover:text-green-600 fi fi-br-edit"></i>
                                <Link confirm="Enter the danger zone..."
                                    confirm-text="Are you ssure?"
                                    confirm-button="Yes, take me there!"
                                    confirm-type="danger"
                                    cancel-button="No, keep me save!"
                                href="/" class="text-xl text-red-400 hover:text-red-600"><i class="fi fi-br-trash"></i></Link>
                            @endcell
                        </x-splade-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
