<x-splade-modal max-width="sm">
    <h1 class="mb-3">{{ $bill->serie }}-{{ $bill->number}}</h1>

    <x-splade-form :default="['bill_id' => $bill->id]" action="{{ route('de.upload') }}" method="POST">
        <x-splade-file lable="Seleccione el archivo PDF" name="file" accept="application/pdf" filepond/>
        <x-splade-submit class="w-full mt-3" label="Cargar archivo"/>
    </x-splade-form>
</x-splade-modal>
