<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-3 mb-3 bg-white shadow-sm sm:rounded-lg">
                <Link modal href="{{ route('us.add') }}" class="flex justify-center px-3 py-2 text-white align-middle bg-blue-600 rounded-md lg:w-1/6 sm:w-full hover:bg-blue-800 hover:shadow-md"><span>Agregar</span> <x-carbon-user-follow class="w-5 ml-2 text-lg" /> </Link>
            </div>
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                        <x-splade-table :for="$users">
                            @cell('Rol', $user)
                            <span class="bg-blue-200 text-blue-800 text-xs font-medium mr-2 px-2.5 py-2 rounded  border border-blue-400">{{ $user->role_name }}</span>
                            @endcell
                            @cell('Actions')
                                <Link confirm="Enter the danger zone..."
                                    confirm-text="Are you ssure?"
                                    confirm-button="Yes, take me there!"
                                    cancel-button="No, keep me save!"
                                href="/" class="text-indigo">Delete</Link>
                            @endcell
                        </x-splade-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
