<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Advertisement Platform</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50">

    <!-- Background -->
    <div class="relative min-h-screen overflow-hidden">

        <!-- Decorative background circles -->
        <div class="absolute -left-32 -top-32 h-80 w-80 rounded-full bg-indigo-200/40 blur-3xl"></div>

        <div class="absolute -bottom-40 -right-32 h-96 w-96 rounded-full bg-purple-200/40 blur-3xl"></div>


        <!-- Main Container -->
        <div class="relative flex min-h-screen items-center justify-center px-4 py-10 sm:px-6">

            <div class="w-full max-w-6xl overflow-hidden rounded-3xl bg-white shadow-2xl ring-1 ring-slate-200">

                <div class="grid lg:grid-cols-2">


                    <!-- ==================================================
                         LEFT BRANDING PANEL
                    =================================================== -->

                    <div class="relative hidden overflow-hidden bg-gradient-to-br from-blue-700 via-indigo-700 to-purple-700 lg:block">

                        <!-- Decorative circles -->

                        <div class="absolute -right-24 -top-24 h-64 w-64 rounded-full bg-white/10"></div>

                        <div class="absolute -bottom-32 -left-24 h-80 w-80 rounded-full bg-blue-400/20"></div>


                        <div class="relative flex min-h-[680px] flex-col justify-between p-12 text-white">


                            <!-- Logo -->

                            <div>

                                <div class="flex items-center gap-3">

                                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/15 text-2xl font-bold backdrop-blur">

                                        A

                                    </div>

                                    <div>

                                        <div class="text-xl font-bold">
                                            Advertisement
                                        </div>

                                        <div class="-mt-1 text-xs font-semibold tracking-[0.25em] text-blue-200">
                                            PLATFORM
                                        </div>

                                    </div>

                                </div>


                                <!-- Main heading -->

                                <div class="mt-16 max-w-lg">

                                    <p class="mb-4 text-sm font-semibold uppercase tracking-[0.2em] text-blue-200">
                                        Welcome to our marketplace
                                    </p>

                                    <h1 class="text-4xl font-extrabold leading-tight xl:text-5xl">

                                        Find What You Need,

                                        <span class="text-blue-300">
                                            Near You
                                        </span>

                                    </h1>

                                    <p class="mt-6 text-lg leading-8 text-blue-100">

                                        Discover products, services and great deals from
                                        trusted sellers — all in one place.

                                    </p>

                                </div>


                                <!-- Features -->

                                <div class="mt-12 space-y-7">


                                    <!-- Feature 1 -->

                                    <div class="flex items-center gap-4">

                                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-white/10 text-xl backdrop-blur">

                                            🔍

                                        </div>

                                        <div>

                                            <h3 class="font-bold">
                                                Wide Variety
                                            </h3>

                                            <p class="mt-1 text-sm text-blue-100">
                                                Find products and services across many categories.
                                            </p>

                                        </div>

                                    </div>


                                    <!-- Feature 2 -->

                                    <div class="flex items-center gap-4">

                                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-white/10 text-xl backdrop-blur">

                                            🛡️

                                        </div>

                                        <div>

                                            <h3 class="font-bold">
                                                Safe & Secure
                                            </h3>

                                            <p class="mt-1 text-sm text-blue-100">
                                                Connect with sellers through our platform.
                                            </p>

                                        </div>

                                    </div>


                                    <!-- Feature 3 -->

                                    <div class="flex items-center gap-4">

                                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-white/10 text-xl backdrop-blur">

                                            💬

                                        </div>

                                        <div>

                                            <h3 class="font-bold">
                                                Easy Communication
                                            </h3>

                                            <p class="mt-1 text-sm text-blue-100">
                                                Contact sellers directly about advertisements.
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </div>


                            <!-- Bottom text -->

                            <div class="mt-10 border-t border-white/10 pt-6">

                                <p class="text-sm text-blue-100">
                                    Buy • Sell • Discover • Connect
                                </p>

                            </div>

                        </div>

                    </div>


                    <!-- ==================================================
                         RIGHT LOGIN PANEL
                    =================================================== -->

                    <div class="flex items-center bg-white px-6 py-10 sm:px-10 lg:px-14 xl:px-20">

                        <div class="mx-auto w-full max-w-md">


                            <!-- Register -->

                            <div class="mb-12 flex justify-end">

                                <p class="text-sm text-slate-500">

                                    Don't have an account?

                                    <a href="{{ route('register') }}"
                                       class="ml-1 font-semibold text-indigo-600 transition hover:text-indigo-800">

                                        Register

                                    </a>

                                </p>

                            </div>


                            <!-- Heading -->

                            <div class="mb-9">

                                <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">

                                    Welcome Back 👋

                                </h2>

                                <p class="mt-3 text-sm leading-6 text-slate-500 sm:text-base">

                                    Log in to your account and continue exploring
                                    amazing opportunities.

                                </p>

                            </div>


                            <!-- Session Status -->

                            @if (session('status'))

                                <div class="mb-5 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-700">

                                    {{ session('status') }}

                                </div>

                            @endif


                            <!-- Login Form -->

                            <form method="POST" action="{{ route('login') }}" class="space-y-6">

                                @csrf


                                <!-- Email -->

                                <div>

                                    <label for="email"
                                           class="mb-2 block text-sm font-semibold text-slate-800">

                                        Email Address

                                    </label>

                                    <div class="relative">

                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 fill="none"
                                                 viewBox="0 0 24 24"
                                                 stroke-width="1.8"
                                                 stroke="currentColor"
                                                 class="h-5 w-5 text-slate-400">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25H4.5a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15A2.25 2.25 0 0 0 2.25 6.75m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.5a2.25 2.25 0 0 1-2.31 0l-7.5-4.5A2.25 2.25 0 0 1 2.25 6.993V6.75" />

                                            </svg>

                                        </div>

                                        <input
                                            id="email"
                                            type="email"
                                            name="email"
                                            value="{{ old('email') }}"
                                            required
                                            autofocus
                                            autocomplete="username"
                                            placeholder="Enter your email address"
                                            class="block w-full rounded-xl border border-slate-200 bg-white py-3.5 pl-12 pr-4 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100"
                                        >

                                    </div>


                                    @if ($errors->has('email'))

                                        <p class="mt-2 text-sm font-medium text-red-600">

                                            {{ $errors->first('email') }}

                                        </p>

                                    @endif

                                </div>


                                <!-- Password -->

                                <div>

                                    <div class="mb-2 flex items-center justify-between">

                                        <label for="password"
                                               class="block text-sm font-semibold text-slate-800">

                                            Password

                                        </label>

                                    </div>


                                    <div class="relative">

                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 fill="none"
                                                 viewBox="0 0 24 24"
                                                 stroke-width="1.8"
                                                 stroke="currentColor"
                                                 class="h-5 w-5 text-slate-400">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      d="M16.5 10.5V6.75a4.5 4.5 0 0 0-9 0v3.75m-1.5 0h12a1.5 1.5 0 0 1 1.5 1.5v8.25a1.5 1.5 0 0 1-1.5 1.5H6a1.5 1.5 0 0 1-1.5-1.5V12a1.5 1.5 0 0 1 1.5-1.5Z" />

                                            </svg>

                                        </div>


                                        <input
                                            id="password"
                                            type="password"
                                            name="password"
                                            required
                                            autocomplete="current-password"
                                            placeholder="Enter your password"
                                            class="block w-full rounded-xl border border-slate-200 bg-white py-3.5 pl-12 pr-12 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100"
                                        >


                                        <!-- Show password -->

                                        <button
                                            type="button"
                                            onclick="togglePassword()"
                                            class="absolute inset-y-0 right-0 flex items-center px-4 text-slate-400 transition hover:text-indigo-600"
                                            aria-label="Show password"
                                        >

                                            <svg id="eyeIcon"
                                                 xmlns="http://www.w3.org/2000/svg"
                                                 fill="none"
                                                 viewBox="0 0 24 24"
                                                 stroke-width="1.8"
                                                 stroke="currentColor"
                                                 class="h-5 w-5">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      d="M2.036 12.322a1.012 1.012 0 0 1 0-.644C3.423 7.51 7.36 4.5 12 4.5c4.64 0 8.577 3.01 9.964 7.178.07.21.07.434 0 .644C20.577 16.49 16.64 19.5 12 19.5c-4.64 0-8.577-3.01-9.964-7.178Z" />

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />

                                            </svg>

                                        </button>

                                    </div>


                                    @if ($errors->has('password'))

                                        <p class="mt-2 text-sm font-medium text-red-600">

                                            {{ $errors->first('password') }}

                                        </p>

                                    @endif

                                </div>


                                <!-- Remember + Forgot -->

                                <div class="flex items-center justify-between gap-4">

                                    <label class="flex cursor-pointer items-center gap-2">

                                        <input
                                            id="remember_me"
                                            type="checkbox"
                                            name="remember"
                                            class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500"
                                        >

                                        <span class="text-sm text-slate-600">
                                            Remember me
                                        </span>

                                    </label>


                                    @if (Route::has('password.request'))

                                        <a href="{{ route('password.request') }}"
                                           class="text-sm font-semibold text-indigo-600 transition hover:text-indigo-800">

                                            Forgot password?

                                        </a>

                                    @endif

                                </div>


                                <!-- Login Button -->

                                <button
                                    type="submit"
                                    class="group flex w-full items-center justify-center gap-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-indigo-200 transition duration-200 hover:-translate-y-0.5 hover:from-blue-700 hover:to-indigo-700 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-indigo-200"
                                >

                                    <span>
                                        Log In
                                    </span>

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke-width="2"
                                         stroke="currentColor"
                                         class="h-5 w-5 transition group-hover:translate-x-1">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M13.5 4.5 19.5 10.5 13.5 16.5M19 10.5H4.5" />

                                    </svg>

                                </button>

                            </form>


                            <!-- Register bottom -->

                            <div class="mt-8 text-center">

                                <p class="text-sm text-slate-500">

                                    Don't have an account?

                                    <a href="{{ route('register') }}"
                                       class="font-semibold text-indigo-600 hover:text-indigo-800">

                                        Create an account

                                    </a>

                                </p>

                            </div>


                            <!-- Footer -->

                            <div class="mt-10 border-t border-slate-100 pt-6 text-center">

                                <p class="text-xs leading-5 text-slate-400">

                                    By continuing, you agree to our

                                    <a href="{{ route('terms') }}"
                                       class="font-medium text-indigo-600 hover:underline">
                                        Terms of Service
                                    </a>

                                    and

                                    <a href="{{ route('privacy') }}"
                                       class="font-medium text-indigo-600 hover:underline">
                                        Privacy Policy
                                    </a>.

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- =========================================================
         PASSWORD TOGGLE
    ========================================================== -->

    <script>

        function togglePassword() {

            const passwordInput = document.getElementById('password');

            const eyeIcon = document.getElementById('eyeIcon');


            if (passwordInput.type === 'password') {

                passwordInput.type = 'text';

                eyeIcon.innerHTML = `
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.315 19.5 12 19.5c.845 0 1.67-.099 2.46-.286M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.685 0 8.774 3.162 10.066 7.5a10.53 10.53 0 0 1-4.132 5.411M6.228 6.228 3 3m3.228 3.228 3.07 3.07m0 0a3 3 0 1 0 4.243 4.243m-4.243-4.243 4.243 4.243m0 0L21 21"
                    />
                `;

            } else {

                passwordInput.type = 'password';

                eyeIcon.innerHTML = `
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.644C3.423 7.51 7.36 4.5 12 4.5c4.64 0 8.577 3.01 9.964 7.178.07.21.07.434 0 .644C20.577 16.49 16.64 19.5 12 19.5c-4.64 0-8.577-3.01-9.964-7.178Z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                    />
                `;

            }

        }

    </script>

</body>

</html>