@extends('layouts.base')

@section('title', 'Settings')

@section('content-base')

    <body class="dark:bg-neutral-800 bg-neutral-100 dark:text-white">

        <!-- ..::  header area start ::.. -->
        <x-admin.sidebar />
        <!-- ..::  header area end ::.. -->


        <main class="dashboard-main">

            <!-- ..::  navbar start ::.. -->
            <x-admin.navbar />
            <!-- ..::  navbar end ::.. -->
            <div class="dashboard-main-body flex">

                <x-admin.setting-sidebar />

                <main class="p-4">
                    @yield('content-settings')
                </main>

            </div>
            <!-- ..::  footer  start ::.. -->
            <x-admin.footer />
            <!-- ..::  footer area end ::.. -->

        </main>

    </body>
@endsection
