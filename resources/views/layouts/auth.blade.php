@extends('layouts.base')

@section('content-base')
    <section class="bg-white dark:bg-dark-2 flex flex-wrap min-h-screen">
        {{-- Left side image --}}
        <div class="lg:w-1/2 lg:block hidden">
            <div class="flex items-center flex-col h-full justify-center">
                <img src="{{ asset('assets/images/auth/auth-img.png') }}" alt="Auth Background">
            </div>
        </div>

        {{-- Right side (form) --}}
        <main class="lg:w-1/2 w-full flex items-center justify-center">
            @yield('content-auth')
        </main>
    </section>
@endsection
