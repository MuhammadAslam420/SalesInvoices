<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class=" shadow bg-green-500">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <nav class="flex ">
                        <ul class="nav nav-tabs nav-tabs-solid bg-green-300">
                            <li class="nav-item">
                                <a href="{{route('dashboard')}}"
                                    class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">{{ __('Dashboard') }}</a>

                            </li>
                            <li class="nav-item">
                                <a href="{{route('receipts')}}"
                                    class="nav-link {{ request()->is('receipts') ? 'active' : '' }}">{{ __('Receipts') }}</a>

                            </li>
                            <li class="nav-item">
                                <a href="{{route('company')}}"
                                    class="nav-link {{ request()->is('company') ? 'active' : '' }}">{{ __('Company') }}</a>

                            </li>
                            <li class="nav-item">
                                <a href="{{ route('sales') }}"
                                    class="nav-link {{ request()->is('sales') ? 'active' : '' }}">All Sales Invoice</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('add_sales') }}"
                                    class="nav-link {{ request()->is('add/sales') ? 'active' : '' }}">Genrate Sales Invoice</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('customers') }}"
                                    class="nav-link {{ request()->is('customers') ? 'active' : '' }}">Customers</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('ledger_statements') }}"
                                    class="nav-link {{ request()->is('ledger-statements') ? 'active' : '' }}">Ledger
                                    Statements</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('setting') }}"
                                    class="nav-link {{ request()->is('settings') ? 'active' : '' }}">Setting</a>
                            </li>

                        </ul>
                    </nav>

                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    @livewireScripts
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
</body>

</html>
