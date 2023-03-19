<Link href="{{ $module->route }}"
    class="p-2 transition duration-150 border border-gray-300 rounded-lg shadow-md cursor-pointer border-1 bg-gradient-to-b from-white to-gray-100 hover:white active:bg-gray-100 hover:scale-105 transform-gpu">
    <div class="flex items-center">
        <div class="w-1/4 p-2 mr-2 border rounded-md shadow-inner bg-gradient-to-b from-primary-300 to-primary-100">
            <img class="w-100" src="{{ asset('images/modules/'.$module->id.'.svg')}}" alt="{{ $module->id}}">
        </div>
        <div class="flex flex-col justify-between">
            <div class="text-xl font-medium">{{ $module->name }}</div>
            <div class="text-sm italic text-gray-600">{{ $module->description }}</div>
        </div>
    </div>
</Link>
