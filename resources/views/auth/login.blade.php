<!-- LOGIN -->
          <!-- <div class="tab-pane fade show active" id="loginPane">
            <h2 class="h5 mb-1">Welcome back<span id="loginRoleLabel" class="text-gold"></span></h2>
            <p class="text-muted-legal small mb-4">Enter your credentials to access your dashboard.</p>
            <form class="needs-validation row g-3" novalidate>
              <div class="alert alert-success d-none" data-role="form-alert">Signed in successfully — redirecting to your dashboard.</div>
              <div class="col-12">
                <label class="form-label small fw-semibold" for="lEmail">Email address</label>
                <input type="email" class="form-control" id="lEmail" required placeholder="you@example.com">
                <div class="invalid-feedback">Enter a valid email address.</div>
              </div>
              <div class="col-12">
                <label class="form-label small fw-semibold" for="lPass">Password</label>
                <div class="input-group">
                  <input type="password" class="form-control" id="lPass" required minlength="6">
                  <button class="btn btn-outline-navy" type="button" data-toggle-pw="lPass"><i class="bi bi-eye"></i></button>
                  <div class="invalid-feedback">Password must be at least 6 characters.</div>
                </div>
              </div>
              <div class="col-12 d-flex justify-content-between align-items-center">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="remember">
                  <label class="form-check-label small" for="remember">Remember me</label>
                </div>
                <a href="#" class="small text-gold">Forgot password?</a>
              </div>
              <div class="col-12"><button class="btn btn-navy w-100 py-2" type="submit">Login</button></div>
            </form>
          </div> -->





<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

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
</x-guest-layout>
