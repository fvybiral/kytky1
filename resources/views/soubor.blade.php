
@extends('layout')

@php
    View::share('activeMenu', 'soubory');
    View::share('showHeader', true);
@endphp

@section('heading')
    <x-h1>Soubor</x-h1>
    <x-h2>{{ $soubor->name }}</x-h2>
@endsection

@section('content')
    <div class="px-4 sm:px-6 lg:px-8" x-data="{upload: false}">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none flex items-center text-nowrap">
{{--                <x-button-link class="ml-2" href="{{url('soubory/'.$soubor->id.'/duplicity')}}">Odstranit duplicity</x-button-link>--}}
                <x-button-link class="ml-2" href="{{url('soubory/'.$soubor->id.'/stahnout')}}">Stáhnout soubor</x-button-link>
            </div>
        </div>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">

                    <div class="mb-10">
                        <div class="border-b border-gray-200">
                            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                                <a href="{{ url('soubory/'.$soubor->id) }}"
                                   class="
                                        @if($tab == 'all')
                                            border-indigo-500 text-indigo-600
                                        @else
                                            border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700
                                        @endif
                                        whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium
                                    ">
                                    Vše
                                </a>
                                <a href="{{ url('soubory/'.$soubor->id.'/nesparovane') }}"
                                   class="
                                        @if($tab == 'unpaired')
                                            border-indigo-500 text-indigo-600
                                        @else
                                            border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700
                                        @endif
                                        whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium
                                    ">
                                    Nespárované
                                </a>
                            </nav>
                        </div>
                    </div>

                    <table class="min-w-full divide-y divide-gray-300 mb-10">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                Vstupní text
                            </th>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                Název
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                Doplněk
                            </th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach ($kytky as $kytka)
                            <tr>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-black">
                                    {{ $kytka->input }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm @if($kytka->encyklopedie) text-black @else text-gray-500 @endif">
                                    <strong>{{ $kytka->nomenklatura->name ?? $kytka->encyklopedie->name }}</strong>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ $kytka->encyklopedie->addition ?? '-'}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $kytky->links() }}
                </div>
            </div>
        </div>
        <livewire:upload-file ref="upload" />
    </div>
@endsection

