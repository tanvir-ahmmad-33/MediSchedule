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
        <div class="block mt-4 flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center text-sm">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm bg-gradient-to-r from-[#3e8064] via-[#3e8064] to-[#1b3d32] font-bold text-transparent bg-clip-text hover:text-transparent hover:bg-gradient-to-r hover:from-[#3e8064] hover:to-[#1b3d32] hover:via-[#3e8064] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <div class="mt-4">
            <x-primary-button class="w-full flex justify-center items-center" style="background: linear-gradient(135deg, #3e8064 0%, #1b3d32 100%);">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <hr class="mt-4 mb-2 border-gray-300">

    <div class="text-center">
        {{ __("Don't have an account? ") }}
        <a href="{{ route('register') }}" class="rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"> 
            <span class="text-transparent bg-gradient-to-r from-[#3e8064] to-[#1b3d32] bg-clip-text font-bold">
                {{ __('Sign up here') }}
            </span>
        </a>
    </div>
</x-guest-layout>

