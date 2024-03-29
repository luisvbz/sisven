@extends('modules.users.base')

@section('header')
    Usuarios / <small>Listado de Usuarios</small>
@endsection

@section('content')
    <div class="py-0">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                {{-- <div class="p-6 bg-white border-b border-gray-200 shadow-lg sm:rounded-lg"> --}}
                <x-splade-table :for="$users" striped>
                    @cell('Estado', $user)
                        @if($user->status)
                        <div class="text-xl text-center text-green-600"><i class="fi fi-br-badge-check"></i></div>
                        @else
                        <div class="text-xl text-center text-red-600"><i class="fi fi-br-ban"></i></div>
                        @endif
                    @endcell
                    @cell('Rol', $user)
                        <span class="bg-primary-200 text-primary-800 text-xs font-medium mr-2 px-2.5 py-2 rounded  border border-primary-400">{{ $user->role_name }}</span>
                    @endcell
                    @cell('Actions', $user)
                        @can('us:edit')
                            <Link href="{{ route('us.edit', [$user])}}"><i class="mr-1 text-xl text-green-400 hover:text-green-600 fi fi-br-edit"></i></Link>
                        @endcan
                        @can('us:delete')
                        <Link confirm="Desea eliminar este usuarios?"
                            confirm-button="Eliminar!"
                            confirm-type="danger"
                            cancel-button="Cancelar"
                            require-password
                            method="DELETE"
                            href="{{ route('us.delete', [$user])}}" class="mr-1 text-xl text-danger-400 hover:text-danger-600"><i class="fi fi-br-trash"></i></Link>
                        @endcan
                        @can('us:activate')
                            <Link confirm="Desea {{ $user->status ? 'desactivar' : 'Activar'}} este usuarios?"
                                confirm-button="Si!"
                                confirm-type="danger"
                                cancel-button="Cancelar"
                                method="POST"
                                href="{{ route('us.toogle-status', [$user])}}" class="text-xl text-primary-400 hover:text-primary-600"><i class="fi fi-br-refresh"></i></Link>
                        @endcan
                    @endcell
                </x-splade-table>
        </div>
    </div>
@endsection
