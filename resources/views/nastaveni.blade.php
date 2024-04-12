@extends('layout')

@php
    View::share('activeMenu', 'nastaveni');
@endphp

@section('content')
    <div class="px-4 sm:px-6 lg:px-8" x-data="{upload: false}">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Nastavení</h1>
                <p class="mt-2 text-sm text-gray-700">Konfigurace aplikace.</p>
            </div>
        </div>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        Zde zatím nic není.
                </div>
            </div>
        </div>
    </div>
@endsection

