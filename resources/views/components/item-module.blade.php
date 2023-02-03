<Link href="{{ $module->route }}"
    class="p-2 mb-2 transition duration-150 border border-gray-300 rounded-lg shadow-md cursor-pointer border-1 bg-gradient-to-b from-gray-100 to-white hover:white active:bg-gray-100 hover:from-white hove:to-gray-100">
    <div class="flex items-center">
        <div class="w-1/4">
            <img src="{{ asset('images/modules/'.$module->id.'.png')}}" alt="{{ $module->id}}">
        </div>
        <div class="flex flex-col justify-between">
            <div class="text-xl font-semibold">{{ $module->name }}</div>
            <div class="text-sm italic text-gray-600">{{ $module->description }}</div>
        </div>
    </div>
</Link>
