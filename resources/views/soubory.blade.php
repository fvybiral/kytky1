@extends('layout')

@php
    View::share('activeMenu', 'soubory');
@endphp

@section('heading')
    <x-h1>Soubory</x-h1>
@endsection

@section('content')
    <div class="px-4 sm:px-6 lg:px-8" x-data="{ upload: false }">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <p class="mt-2 text-sm text-gray-700">Seznam nahraných souborů s původními daty.</p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <button type="button"
                        class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        @click="upload=true">
                    Nový soubor
                </button>
            </div>
        </div>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Stav
                                </th>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Název
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Počet řádků
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Stav
                                </th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Akce</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach ($soubory as $soubor)
                                <tr>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $soubor->state }}
                                    </td>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                        <a href="{{ url('soubory/' . $soubor->id) }}"
                                           class="underline hover:no-underline text-indigo-600">
                                            {{ $soubor->name }}
                                        </a>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ $soubor->lines_count ?? '-' }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm @if ($soubor->progress == 100) text-green-600 @else text-gray-500 @endif">
                                        {{ $soubor->progress ?? 0 }}%
                                    </td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 text-nowrap">
                                        <a href="{{ url('soubory/' . $soubor->id) }}"
                                           class="text-indigo-600 hover:text-indigo-900">
                                            Otevřít
                                            <span class="sr-only">Otevřít</span>
                                        </a>
                                        <form action="{{ route('soubory.destroy', ['soubory' => $soubor->id]) }}"
                                              method="POST" class="inline-block ml-4">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900"
                                                    onclick="return confirm('Opravdu chceš smazat tento soubor?')">
                                                Smazat
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <livewire:upload-file ref="upload"/>
    </div>
@endsection
