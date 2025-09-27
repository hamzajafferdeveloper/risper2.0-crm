@extends('layouts.base')

@section('content-base')
    <body class="dark:bg-neutral-800 bg-neutral-100 dark:text-white">

    <!-- ..::  header area start ::.. -->
    <x-admin.sidebar />
    <!-- ..::  header area end ::.. -->

    <main class="dashboard-main">

        <!-- ..::  navbar start ::.. -->
        <x-admin.navbar />
        <!-- ..::  navbar end ::.. -->
        <div class="dashboard-main-body">

            <!-- ..::  breadcrumb  start ::.. -->
            {{-- <x-breadcrumb title='{{ isset($title) ? $title : "" }}' subTitle='{{ isset($subTitle) ? $subTitle : "" }}' /> --}}
            <!-- ..::  header area end ::.. -->

            @yield('content-admin')

        </div>
        <!-- ..::  footer  start ::.. -->
        <x-admin.footer />
        <!-- ..::  footer area end ::.. -->

    </main>

    <!-- ..::  scripts  start ::.. -->
    {{-- <x-script  script='{!! isset($script) ? $script : "" !!}' /> --}}
    <!-- ..::  scripts  end ::.. -->

</body>
@endsection
