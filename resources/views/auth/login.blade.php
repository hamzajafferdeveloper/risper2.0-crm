@extends('layouts.auth')

@section('title', 'Login')

@section('content-auth')
    <div class="lg:max-w-[464px] w-full px-6">
        {{-- Logo --}}
        <div>
            <a class="mb-2.5 max-w-[290px] inline-block">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo">
            </a>
            <h4 class="mb-3 text-2xl font-bold">Sign In to your Account</h4>
            <p class="mb-8 text-secondary-light text-lg">
                Welcome back! please enter your details
            </p>
        </div>

        {{-- Form --}}
        <form action="#" method="POST">
            @csrf

            {{-- Email --}}
            <div class="relative mb-4">
                <span class="absolute start-4 top-1/2 -translate-y-1/2 text-xl text-gray-400">
                    <iconify-icon icon="mage:email"></iconify-icon>
                </span>
                <input
                    type="email"
                    name="email"
                    placeholder="Email"
                    class="form-control h-[56px] ps-11 w-full border-neutral-300 bg-neutral-50 dark:bg-dark-2 rounded-xl"
                >
            </div>

            {{-- Password --}}
            <div class="relative mb-5 border-red-600">
                <span class="absolute start-4 top-1/2 -translate-y-1/2 text-xl text-gray-400">
                    <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                </span>
                <input
                    type="password"
                    id="your-password"
                    name="password"
                    placeholder="Password"
                    class="form-control h-[56px] ps-11 w-full border-neutral-300 bg-neutral-50 dark:bg-dark-2 rounded-xl"
                >
                <span
                    class="toggle-password cursor-pointer absolute end-4 top-1/2 -translate-y-1/2 text-gray-400"
                    data-toggle="#your-password"
                >
                    <i class="ri-eye-line"></i>
                </span>
            </div>

            {{-- Remember me + Forgot password --}}
            <div class="flex justify-between items-center mb-6">
                <label class="flex items-center">
                    <input type="checkbox" class="form-check-input border border-neutral-300">
                    <span class="ml-2">Remember me</span>
                </label>
                <a href="#" class="text-primary-600 font-medium hover:underline">
                    Forgot Password?
                </a>
            </div>

            {{-- Submit --}}
            <button
                type="submit"
                class="btn btn-primary w-full py-3 rounded-xl text-white font-semibold"
            >
                Sign In
            </button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll(".toggle-password").forEach(toggle => {
                toggle.addEventListener("click", function () {
                    const input = document.querySelector(this.getAttribute("data-toggle"));
                    const icon = this.querySelector("i");

                    if (input.type === "password") {
                        input.type = "text";
                        icon.classList.remove("ri-eye-line");
                        icon.classList.add("ri-eye-off-line");
                    } else {
                        input.type = "password";
                        icon.classList.remove("ri-eye-off-line");
                        icon.classList.add("ri-eye-line");
                    }
                });
            });
        });
    </script>
@endpush
