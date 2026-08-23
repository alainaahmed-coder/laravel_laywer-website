<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login or Register — Client &amp; Lawyer Accounts | LegalEase</title>
    <meta name="description" content="Sign in to LegalEase or create a client account to book consultations. Advocates can register with Bar Council ID, specialization and office details.">
    <meta property="og:title" content="Login or Register — Client &amp; Lawyer Accounts | LegalEase">
    <meta property="og:description" content="One place for client and lawyer authentication on the LegalEase platform.">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body class="bg-light-gray">

    <div class="container py-5">
        <div class="text-center mb-4">
            <a class="navbar-brand d-inline-flex align-items-center gap-2" href="index.html">
                <span class="brand-badge"><i class="bi bi-bank2"></i></span>
                <span class="brand-text">Legal<span>Ease</span></span>
            </a>
        </div>

        <div class="row justify-content-center g-4">
            <div class="col-lg-5 d-none d-lg-block">
                <div class="auth-aside h-100">
                    <h1 class="h3 text-white">Legal help, without the guesswork.</h1>
                    <p class="opacity-75">Join thousands of clients and advocates using LegalEase to schedule verified consultations.</p>
                    <ul class="list-unstyled d-grid gap-3 mt-4 small">
                        <li><i class="bi bi-patch-check-fill text-gold me-2"></i>Bar Council verified advocates</li>
                        <li><i class="bi bi-calendar2-check-fill text-gold me-2"></i>Instant slot booking &amp; reminders</li>
                        <li><i class="bi bi-shield-lock-fill text-gold me-2"></i>Confidential case notes and documents</li>
                        <li><i class="bi bi-cash-coin text-gold me-2"></i>Transparent consultation fees</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card-legal p-4 p-lg-5">

                    <!-- Role Toggle -->
                    <ul class="nav nav-pills nav-pills-legal nav-fill gap-2 mb-4" role="tablist">

                        <li class="nav-item">
                            <button
                                class="nav-link active"
                                id="roleClientBtn"
                                type="button">
                                <i class="bi bi-person me-1"></i>
                                Login
                            </button>
                        </li>

                        <li class="nav-item">
                            <button
                                class="nav-link"
                                id="roleLawyerBtn"
                                type="button">
                                <i class="bi bi-briefcase me-1"></i>
                                Register
                            </button>
                        </li>

                    </ul>


                    <!-- ================= CUSTOMER LOGIN ================= -->

                    <div id="customerLogin">

                        <h2 class="h5 mb-1">
                            Welcome back
                        </h2>

                        <p class="text-muted-legal small mb-4">
                            Login to access your customer dashboard.
                        </p>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email Address -->
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Password -->
                            <div class="mt-4">
                                <x-input-label for="password" :value="__('Password')" />

                                <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />

                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Remember Me -->
                            <div class="block mt-4">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                </label>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                                @endif

                                <x-primary-button class="ms-3">
                                    {{ __('Log in') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>


                    <!-- ================= LAWYER REGISTER ================= -->

                    <div id="lawyerRegister" class="d-none">

                        <h2 class="h5 mb-1">
                            Create your lawyer account
                        </h2>

                        <p class="text-muted-legal small mb-4">
                            Register your account to join LegalEase.
                        </p>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <!-- Name -->
                                <div class="col-md-6">
                                    <x-input-label for="name" :value="__('Name')" />
                                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <!-- Email Address -->
                                <div class="col-md-6">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold" for="rPhone">Phone</label>
                                    <input type="tel" name="phone" class="form-control" id="rPhone" required pattern="[0-9+\- ]{10,15}" placeholder="+92 300 1234567">
                                    <div class="invalid-feedback">Enter a valid phone number.</div>
                                </div>
                                <!-- Role -->
                                <div class="col-md-6">
                                    <x-input-label for="role" :value="__('Register As')" />

                                    <select id="role" name="role"
                                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                        <option value="">Select Role</option>
                                        <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>
                                            Customer
                                        </option>
                                        <option value="lawyer" {{ old('role') == 'lawyer' ? 'selected' : '' }}>
                                            Lawyer
                                        </option>
                                    </select>

                                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                                </div>

                                <!-- Password -->
                                <div class="col-md-6">
                                    <x-input-label for="password" :value="__('Password')" />

                                    <x-text-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password" />

                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <!-- Confirm Password -->
                                <div class="col-md-6">
                                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                        type="password"
                                        name="password_confirmation" required autocomplete="new-password" />

                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>

                                <!-- Register Button -->
                                <div class="col-12 mt-5">

                                    <button
                                        type="submit"
                                        class="btn btn-gold w-100 py-2">

                                        Create Account +

                                    </button>

                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>


            <script>
                const customerBtn = document.getElementById('roleClientBtn');
                const lawyerBtn = document.getElementById('roleLawyerBtn');

                const customerLogin = document.getElementById('customerLogin');
                const lawyerRegister = document.getElementById('lawyerRegister');


                customerBtn.addEventListener('click', function() {

                    customerBtn.classList.add('active');
                    lawyerBtn.classList.remove('active');

                    customerLogin.classList.remove('d-none');
                    lawyerRegister.classList.add('d-none');

                });


                lawyerBtn.addEventListener('click', function() {

                    lawyerBtn.classList.add('active');
                    customerBtn.classList.remove('active');

                    lawyerRegister.classList.remove('d-none');
                    customerLogin.classList.add('d-none');

                });


                function togglePassword(inputId, button) {

                    const input = document.getElementById(inputId);

                    if (input.type === 'password') {

                        input.type = 'text';

                        button.innerHTML = '<i class="bi bi-eye-slash"></i>';

                    } else {

                        input.type = 'password';

                        button.innerHTML = '<i class="bi bi-eye"></i>';

                    }

                }
            </script>
</body>

</html>



<x-guest-layout>

</x-guest-layout>