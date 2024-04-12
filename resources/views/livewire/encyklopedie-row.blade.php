<tr>
    @if($zaznam->nomenklaturaid || $zaznam->name == 'XXX')
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $zaznam->input }}</td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            @if($zaznam->name == 'XXX')
                <span class="bg-red-500 text-white rounded text-xs py-1 px-2">{{ $zaznam->name }}</span>
            @else
                {{ $zaznam->name }}
            @endif
        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $zaznam->addition }}</td>
        <td class="whitespace-nowrap px-3 py-4 text-indigo-600 text-center text-sm font-medium">
            <button
                wire:click="fix"
            >
                Opravit
                <span class="sr-only">Opravit</span>
            </button>
        </td>
    @else
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $zaznam->input }}</td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-black">
            <input wire:model.live="query" class="@if($selected) border-green-500 @endif" size="40" />
            @if($this->query != $this->initial)
                <button type="button" wire:click="select(null)" class="rounded-full w-7 bg-indigo-600 p-1 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                   X
                </button>
            @endif
            @if($result && !$selected)
                <div class="absolute shadow min-w-80 bg-white p-2 max-h-64 overflow-y-auto mt-1">
                    @foreach ($result as $row)
                        <div wire:click="select({{$row->id}})" class="hover:bg-gray-100 p-2 group flex items-center justify-between cursor-pointer">
                            <span>{{ $row->name }}</span>
                            <button type="button" class="hidden group-hover:inline-block rounded bg-white px-2 py-1 text-xs font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">nastavit</button>
                        </div>
                    @endforeach
                </div>
            @endif
        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            <input wire:model.live="addition" class="@if($addition) border-green-500 @endif"/>
        </td>
        <td
            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 text-center">
            <button
                wire:click="save"
                class="@if (!$selected) text-gray-400 @else text-indigo-600 hover:text-indigo-900 @endif"
                @if (!$selected) disabled @endif
            >
                Uložit
                <span class="sr-only">Uložit</span>
            </button>
            <button wire:click="cancel" wire:confirm="Určitě?" class="ml-5 text-indigo-600 hover:text-indigo-900">
                Nastavit XXX
                <span class="sr-only">Zrušit</span>
            </button>
        </td>
    @endif
</tr>
