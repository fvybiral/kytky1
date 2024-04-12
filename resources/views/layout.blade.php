@extends('master')

@php
    $menu = [
        'soubory' => [
            'name' => 'Soubory',
            'url' => url('soubory'),
            'icon' =>
                '<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="fill-current h-6 w-6 shrink-0 text-white" viewBox="0 0 50 50"><path d="M 7 2 L 7 48 L 43 48 L 43 15.410156 L 29.183594 2 Z M 9 4 L 28 4 L 28 17 L 41 17 L 41 46 L 9 46 Z M 30 5.578125 L 39.707031 15 L 30 15 Z M 20.234375 23.710938 C 18.265625 23.710938 16.152344 25.195313 16.152344 29.003906 C 16.152344 31.871094 17.382813 34 19.964844 34 C 20.652344 34 21.207031 33.894531 21.492188 33.761719 L 21.296875 32.109375 C 21.058594 32.183594 20.679688 32.261719 20.351563 32.261719 C 19.152344 32.261719 18.234375 31.316406 18.234375 28.902344 C 18.234375 26.394531 19.242188 25.4375 20.351563 25.4375 C 20.785156 25.4375 21.042969 25.527344 21.265625 25.628906 L 21.597656 23.980469 C 21.402344 23.84375 20.921875 23.710938 20.234375 23.710938 Z M 25.375 23.710938 C 23.261719 23.710938 22.183594 25.058594 22.183594 26.679688 C 22.183594 27.59375 22.707031 28.660156 24.085938 29.5 C 24.941406 30.054688 25.390625 30.414063 25.390625 31.152344 C 25.390625 31.808594 24.941406 32.289063 24.011719 32.289063 C 23.441406 32.289063 22.75 32.125 22.347656 31.902344 L 22.0625 33.59375 C 22.394531 33.789063 23.1875 34 23.996094 34 C 25.976563 34 27.34375 32.785156 27.34375 30.9375 C 27.34375 29.875 26.847656 28.855469 25.515625 28.046875 C 24.417969 27.386719 24.117188 27.070313 24.117188 26.46875 C 24.117188 25.929688 24.519531 25.421875 25.359375 25.421875 C 25.929688 25.421875 26.367188 25.585938 26.652344 25.765625 L 26.96875 24.070313 C 26.667969 23.890625 26.035156 23.710938 25.375 23.710938 Z M 27.628906 23.800781 L 29.890625 33.90625 L 32.09375 33.90625 L 34.40625 23.800781 L 32.246094 23.800781 L 31.558594 28.121094 C 31.375 29.257813 31.210938 30.476563 31.078125 31.675781 L 31.046875 31.675781 C 30.914063 30.492188 30.703125 29.242188 30.523438 28.164063 L 29.800781 23.800781 Z"></path></svg>',
        ],
        'encyklopedie' => [
            'name' => 'Encyklopedie',
            'url' => url('encyklopedie-nesparovane'),
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"  class="fill-current h-6 w-6 shrink-0 text-white" viewBox="0 0 50 50"><path d="M 12 2 C 8.699219 2 6 4.699219 6 8 L 6 42.417969 C 6 45.59375 8.832031 48 12 48 L 44 48 L 44 46 L 12 46 C 9.839844 46 8 44.378906 8 42.417969 C 8 40.457031 9.800781 39 12 39 L 44 39 L 44 2 Z M 12 4 L 42 4 L 42 37 L 12 37 C 10.507813 37 9.09375 37.539063 8 38.417969 L 8 8 C 8 5.78125 9.78125 4 12 4 Z M 15 9 C 13.90625 9 13 9.90625 13 11 L 13 15 C 13 16.09375 13.90625 17 15 17 L 36 17 C 37.09375 17 38 16.09375 38 15 L 38 11 C 38 9.90625 37.09375 9 36 9 Z M 15 11 L 36 11 L 36 15 L 15 15 Z"></path></svg>'
        ],
        'nomenklatura' => [
            'name' => 'Nomenklatura',
            'url' => url('nomenklatura'),
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="fill-current h-6 w-6 shrink-0 text-white" viewBox="0 0 50 50"> <path d="M 25.037109 2 A 1.0001 1.0001 0 0 0 24.576172 2.09375 L 2.5761719 12.380859 A 1.0001 1.0001 0 0 0 2 13.285156 L 2 15 A 1.0001 1.0001 0 0 0 3 16 L 5 16 C 5 17.29975 5.8348345 18.43211 7 18.833984 L 7 37.150391 C 5.8280314 37.539726 5 38.695112 5 40 L 5 41 L 4.8457031 41 C 3.2400822 41 2 42.397208 2 44 L 2 47 L 48 47 L 48 44 C 48 42.397208 46.759918 41 45.154297 41 L 45 41 L 45 40 C 45 38.695112 44.171969 37.539726 43 37.150391 L 43 18.833984 C 44.165166 18.43211 45 17.29975 45 16 L 47 16 A 1.0001 1.0001 0 0 0 48 15 L 48 13.285156 A 1.0001 1.0001 0 0 0 47.423828 12.380859 L 25.423828 2.09375 A 1.0001 1.0001 0 0 0 25.037109 2 z M 25 4.1035156 L 46 13.921875 L 46 14 L 4 14 L 4 13.921875 L 25 4.1035156 z M 7 16 L 43 16 C 43 16.5883 42.580604 17 42.091797 17 L 22 17 L 18 17 L 7.9082031 17 C 7.4193959 17 7 16.5883 7 16 z M 9 19 L 11 19 L 11 37 L 9 37 L 9 19 z M 13 19 L 17 19 L 17 37 L 13 37 L 13 19 z M 19 19 L 21 19 L 21 37 L 19 37 L 19 19 z M 23 19 L 27 19 L 27 37 L 23 37 L 23 19 z M 29 19 L 31 19 L 31 37 L 29 37 L 29 19 z M 33 19 L 37 19 L 37 37 L 33 37 L 33 19 z M 39 19 L 41 19 L 41 37 L 39 37 L 39 19 z M 7.8457031 39 L 18 39 L 22 39 L 42.154297 39 C 42.588676 39 43 39.394792 43 40 L 43 41 L 7 41 L 7 40 C 7 39.394792 7.411324 39 7.8457031 39 z M 4.8457031 43 L 45.154297 43 C 45.588676 43 46 43.394792 46 44 L 46 45 L 4 45 L 4 44 C 4 43.394792 4.411324 43 4.8457031 43 z"></path> </svg>'
        ],
    ];
    $activeMenu = $activeMenu ?? 'soubory';
@endphp

@section('page')
    <div x-data="{ open: false }" @keydown.window.escape="open = false">

        <div x-show="open" class="relative z-50 lg:hidden"
            x-description="Off-canvas menu for mobile, show/hide based on off-canvas menu state." x-ref="dialog"
            aria-modal="true" style="display: none;">

            <div x-show="open" x-transition:enter="transition-opacity ease-linear duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/80"
                x-description="Off-canvas menu backdrop, show/hide based on off-canvas menu state." style="display: none;">
            </div>


            <div class="fixed inset-0 flex">

                <div x-show="open" x-transition:enter="transition ease-in-out duration-300 transform"
                    x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transition ease-in-out duration-300 transform"
                    x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                    x-description="Off-canvas menu, show/hide based on off-canvas menu state."
                    class="relative mr-16 flex w-full max-w-xs flex-1" @click.away="open = false" style="display: none;">

                    <div x-show="open" x-transition:enter="ease-in-out duration-300" x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-300"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                        x-description="Close button, show/hide based on off-canvas menu state."
                        class="absolute left-full top-0 flex w-16 justify-center pt-5" style="display: none;">
                        <button type="button" class="-m-2.5 p-2.5" @click="open = false">
                            <span class="sr-only">Close sidebar</span>
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Sidebar component, swap this element with another sidebar if you like -->
                    <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-indigo-600 px-6 pb-4">
                        <div class="flex h-16 shrink-0 items-center text-white">
                            @include('icons.kytka')
                        </div>
                        <nav class="flex flex-1 flex-col">
                            <ul role="list" class="flex flex-1 flex-col gap-y-7">
                                <li>
                                    <ul role="list" class="-mx-2 space-y-1">
                                        @foreach ($menu as $key => $item)
                                            <li>
                                                @if ($key == $activeMenu)
                                                    <a href="{{ $item['url'] }}"
                                                        class="bg-indigo-700 text-white group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold"
                                                        x-state:on="Current" x-state:off="Default"
                                                        x-state-description="Current: &quot;bg-indigo-700 text-white&quot;, Default: &quot;text-indigo-200 hover:text-white hover:bg-indigo-700&quot;">
                                                        {!! $item['icon'] !!}
                                                        {{ $item['name'] }}
                                                    </a>
                                                @else
                                                    <a href="{{ $item['url'] }}"
                                                        class="text-indigo-200 hover:text-white hover:bg-indigo-700 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold"
                                                        x-state-description="undefined: &quot;bg-indigo-700 text-white&quot;, undefined: &quot;text-indigo-200 hover:text-white hover:bg-indigo-700&quot;">
                                                        {!! $item['icon'] !!}
                                                        {{ $item['name'] }}
                                                    </a>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="mt-auto">
                                    <a href="{{ url('nastaveni') }}"
                                        class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-indigo-200 hover:bg-indigo-700 hover:text-white">
                                        <svg class="h-6 w-6 shrink-0 text-indigo-200 group-hover:text-white" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        Nastavení
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>
        </div>

        <!-- Static sidebar for desktop -->
        <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-indigo-600 px-6 pb-4">
                <div class="flex h-16 shrink-0 items-center text-white">
                    @include('icons.kytka')
                </div>
                <nav class="flex flex-1 flex-col">
                    <ul role="list" class="flex flex-1 flex-col gap-y-7">
                        <li>
                            <ul role="list" class="-mx-2 space-y-1">
                                @foreach ($menu as $key => $item)
                                    <li>
                                        @if ($key == $activeMenu)
                                            <a href="{{ $item['url'] }}"
                                                class="bg-indigo-700 text-white group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                                {!! $item['icon'] !!}
                                                {{ $item['name'] }}
                                            </a>
                                        @else
                                            <a href="{{ $item['url'] }}"
                                                class="text-indigo-200 hover:text-white hover:bg-indigo-700 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                                {!! $item['icon'] !!}
                                                {{ $item['name'] }}
                                            </a>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="mt-auto">
                            <a href="{{ url('nastaveni') }}"
                                class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-indigo-200 hover:bg-indigo-700 hover:text-white">
                                <svg class="h-6 w-6 shrink-0 text-indigo-200 group-hover:text-white" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Nastavení
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="lg:pl-72">
            @if($showHeader ?? true)
            <div
                class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
                <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" @click="open = true">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
                    </svg>
                </button>

                <!-- Separator -->
                <div class="h-6 w-px bg-gray-900/10 lg:hidden" aria-hidden="true"></div>

                @yield('heading')
            </div>
            @endif

            <main class="py-10">
                @if (flash()->message)
                    <script>
                        (new Notyf()).{{ flash()->class }}(@json(flash()->message))
                    </script>
                @endif
                @yield('content')
            </main>
        </div>
        @yield('body-append')
    </div>
@endsection
