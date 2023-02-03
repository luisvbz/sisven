<div class="flex items-center">
    <Link href="{{ $route }}" class="self-center mr-2 text-2xl leading-4 text-indigo-600 hover:text-indigo-800"><i class="fi fi-br-arrow-alt-circle-left"></i></Link>
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ $module }} @if(isset($page))<small class="text-gray-600">/ {{ $page }}</small>@endif
    </h2>
</div>
