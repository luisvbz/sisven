<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @can('us:access')
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
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
