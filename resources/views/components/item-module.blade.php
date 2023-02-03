<Link href="{{ $module->route }}"
    class="p-2 mb-2 transition duration-150 border border-gray-300 rounded-lg shadow-md cursor-pointer border-1 bg-gradient-to-b from-gray-100 to-white hover:white active:bg-gray-100 hover:from-white hove:to-gray-100">
    <div class="flex items-center">
        <div class="w-1/4 p-2 mr-2 border border-indigo-300 rounded-md bg-gradient-to-b from-indigo-300 to-indigo-100">
            <img class="w-100" src="{{ asset('images/modules/'.$module->id.'.svg')}}" alt="{{ $module->id}}">
        </div>
        <div class="flex flex-col justify-between">
            <div class="text-xl font-medium">{{ $module->name }}</div>
            <div class="text-sm italic text-gray-600">{{ $module->description }}</div>
        </div>
    </div>
</Link>
