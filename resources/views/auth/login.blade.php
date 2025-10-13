@extends('layouts.auth')

@section('title', 'Login')

@section('content-auth')
    <div class="lg:max-w-[464px] w-full px-6">
        {{-- Logo --}}
        <div>
            <a class="mb-2.5 max-w-[290px] inline-block">
                <img src="{{ asset('assets/images/logo.svg') }}" alt="Logo">
            </a>
            <h4 class="mb-3 text-2xl font-bold">Sign In to your Account</h4>
            <p class="mb-8 text-secondary-light text-lg">
                Welcome back! please enter your details
            </p>
        </div>

        {{-- Form --}}
        <form id="loginForm">
            @csrf

            {{-- Email --}}
            <div class="relative mb-2">
                <span class="absolute inset-y-0 start-4 flex items-center text-xl text-gray-400">
                    <iconify-icon icon="mage:email"></iconify-icon>
                </span>
                <input type="email" name="email" placeholder="Email"
                    class="form-control h-[56px] ps-11 w-full border-neutral-300 bg-neutral-50 dark:bg-dark-2 rounded-xl">
            </div>
            <span class="text-sm text-red-600 mb-3 block" id="error-email"></span>

            {{-- Password --}}
            <div class="relative mb-2">
                <span class="absolute inset-y-0 start-4 flex items-center text-xl text-gray-400">
                    <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                </span>
                <input type="password" id="your-password" name="password" placeholder="Password"
                    class="form-control h-[56px] ps-11 pe-11 w-full border-neutral-300 bg-neutral-50 dark:bg-dark-2 rounded-xl">
                <span class="toggle-password cursor-pointer absolute inset-y-0 end-4 flex items-center text-gray-400"
                    data-toggle="#your-password">
                    <i class="ri-eye-line"></i>
                </span>
            </div>
            <span class="text-sm text-red-600 mb-3 block" id="error-password"></span>

            {{-- General error --}}
            <div id="error-general"
                class="hidden mb-5 rounded-lg bg-red-100 border border-red-300 text-red-700 px-4 py-3 text-sm"></div>

            {{-- Submit --}}
            <button type="submit" id="loginBtn"
                class="btn btn-primary !bg-[#8D35E3] w-full py-3 rounded-xl text-white font-semibold flex items-center justify-center gap-2">
                <span class="btn-text">Sign In</span>
                <span
                    class="loader hidden w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></span>
            </button>
        </form>

    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $(".toggle-password").on("click", function() {
                const input = $($(this).data("toggle"));
                const icon = $(this).find("i");

                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                    icon.removeClass("ri-eye-line").addClass("ri-eye-off-line");
                } else {
                    input.attr("type", "password");
                    icon.removeClass("ri-eye-off-line").addClass("ri-eye-line");
                }
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#loginForm").on("submit", function(e) {
                e.preventDefault();

                const $btn = $("#loginBtn");
                const $text = $btn.find(".btn-text");
                const $loader = $btn.find(".loader");

                // Show loading state
                $btn.prop("disabled", true);
                $text.text("Signing in...");
                $loader.removeClass("hidden");

                let formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('authenticate') }}",
                    method: "POST",
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            window.location.href = response.redirect ||
                                "{{ route('admin.dashboard') }}";
                        } else {
                            $("#errorBox").removeClass("hidden").html(response.message ||
                                "Login failed.");
                        }
                    },
                    error: function(xhr) {
                        $("#error-email").text("");
                        $("#error-password").text("");
                        $("#error-general").addClass("hidden").text("");

                        let errors = xhr.responseJSON?.errors;
                        let message = xhr.responseJSON?.message;

                        if (errors) {
                            if (errors.email) $("#error-email").text(errors.email[0]);
                            if (errors.password) $("#error-password").text(errors.password[0]);
                        } else if (message) {
                            $("#error-general").removeClass("hidden").text(message);
                        } else {
                            $("#error-general").removeClass("hidden").text(
                                "Unauthorized request.");
                        }
                    },
                    complete: function() {
                        // Hide loading state
                        $btn.prop("disabled", false);
                        $text.text("Sign In");
                        $loader.addClass("hidden");
                    }
                });
            });
        });
    </script>
@endpush
