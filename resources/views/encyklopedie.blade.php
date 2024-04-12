@extends('layout')

@php
    View::share('activeMenu', 'encyklopedie');
@endphp

@section('heading')
    <x-h1>Encyklopedie</x-h1>
@endsection

@section('content')
    <div class="px-4 sm:px-6 lg:px-8" x-data="{upload: false}">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <p class="mt-2 text-sm text-gray-700">
                    Databáze původních názvů a jejich nových výrazů.
                </p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none flex items-center text-nowrap">
                <x-button-link class="ml-2" href="{{url('encyklopedie-stahnout')}}">
                    Stáhnout slovník s opravami
                </x-button-link>
                <button
                    type="button"
                    class="ml-2 block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                    @click="upload=true"
                >
                    Import
                </button>
            </div>
        </div>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="mb-10">
                        <div class="border-b border-gray-200">
                            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                                <a href="{{ url('encyklopedie-nesparovane') }}"
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
                                <a href="{{ url('encyklopedie') }}"
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
                            </nav>
                        </div>
                    </div>

                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg mb-10">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                    CSV
                                </th>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                    Název
                                </th>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                    Doplněk
                                </th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Akce</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach ($encyklopedie as $zaznam)
                                <livewire:encyklopedie-row :zaznam="$zaznam"/>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $encyklopedie->links() }}
                </div>
            </div>
        </div>
        <livewire:upload-encyklopedie ref="upload"/>
    </div>
@endsection

