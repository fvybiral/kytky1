<form wire:submit.prevent="save">
    <x-dialog ref="upload" x-cloak>
        <x-upload name="soubor">
            <x-slot:icon>
                @include('icons.csv', ['class' => 'mx-auto h-12 w-12 text-gray-300'])
            </x-slot:icon>
            Nahrát CSV soubor
        </x-upload>
        <x-slot:buttons>
            <x-button type="submit">Nahrát</x-button>
            <x-button @click="upload=false" type="button">Zavřít</x-button>
        </x-slot>
    </x-dialog>
</form>
