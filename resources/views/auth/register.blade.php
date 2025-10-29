<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mt-4 flex space-x-4">
            <!-- First Name Field -->
            <div class="w-1/2">
                <x-input-label for="first_name" :value="__('First Name')" />
                <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus />
                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>

            <!-- Last Name Field -->
            <div class="w-1/2">
                <x-input-label for="last_name" :value="__('Last Name')" />
                <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required />
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>
        </div>
        
        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" required autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>


        <!-- Password and Confirm Password -->
        <div class="mt-4 flex space-x-4">
            <!-- Password Field -->
            <div class="w-1/2">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password Field -->
            <div class="w-1/2">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <!-- Role and Gender -->
        <div class="mt-4 flex space-x-4">
            <!-- Role -->
            <div class="w-1/2">
                <x-input-label for="role" :value="__('Role')" />
                <select id="role" name="role" class="block mt-1 w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm bg-white hover:bg-gray-50 focus:outline-none">
                    <option value="" selected disabled>{{ __('Select a role') }}</option>
                    <option value="patient">{{ __('Patient') }}</option>
                    <option value="staff">{{ __('Staff') }}</option>
                    <option value="doctor">{{ __('Doctor') }}</option>
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>

            <!-- Gender -->
            <div class="w-1/2">
                <x-input-label for="gender" :value="__('Gender')" />
                <select id="gender" name="gender" class="block mt-1 w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm bg-white hover:bg-gray-50 focus:outline-none">
                    <option value="" selected disabled>{{ __('Select gender') }}</option>
                    <option value="male">{{ __('Male') }}</option>
                    <option value="female">{{ __('Female') }}</option>
                    <option value="other">{{ __('Other') }}</option>
                </select>
                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
            </div>
        </div>



        <div class="mt-4">
            <x-primary-button class="w-full flex justify-center items-center" style="background: linear-gradient(135deg, #3e8064 0%, #1b3d32 100%);">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <hr class="mt-4 mb-2 border-gray-300">

    <div class="text-center">
        <a class="underline text-transparent bg-gradient-to-r from-[#3e8064] to-[#1b3d32] bg-clip-text hover:text-transparent hover:bg-gradient-to-r hover:from-[#3e8064] hover:to-[#1b3d32] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
        {{ __('Already registered?') }}
        </a>
    </div>

</x-guest-layout>
