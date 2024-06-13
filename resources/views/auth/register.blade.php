<x-guest-layout>
    <div class="bg-white dark:bg-gray-900">
        <div class="flex justify-center h-screen">
            <div class="hidden bg-cover lg:block lg:w-2/3" style="background-image: url({{ asset('/images/novanieuws2.jpg') }})">
                    <div class="flex items-center h-full px-20 bg-gray-900 bg-opacity-40">
                    <div>
                        <h2 class="text-4xl font-bold text-white">Registreer!</h2>
                        <p class="max-w-xl mt-3 text-gray-300">om nieuws te maken en om nieuws te lezen!</p>
                    </div>
                </div>
            </div>
            <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-2/6">
                <div class="flex-1">
                    <div class="text-center">
                        <h2 class="text-4xl font-bold text-center text-gray-700 dark:text-white">Registreer</h2>
                        <p class="mt-3 text-gray-500 dark:text-gray-300">Sign in</p>
                    </div>
                    <div class="mt-8">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- First Name -->
                            <div>
                                <x-input-label for="firstname" :value="__('First Name')" />
                                <x-text-input id="firstname" class="block w-full mt-1" type="text" name="firstname" :value="old('firstname')" required autofocus autocomplete="given-name" />
                                <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
                            </div>

                            <!-- Last Name -->
                            <div class="mt-4">
                                <x-input-label for="lastname" :value="__('Last Name')" />
                                <x-text-input id="lastname" class="block w-full mt-1" type="text" name="lastname" :value="old('lastname')" required autocomplete="family-name" />
                                <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                            </div>

                            <!-- Email Address -->
                            <div class="mt-4">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Password -->
                            <div class="mt-4">
                                <x-input-label for="password" :value="__('Password')" />
                                <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="mt-4">
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                <x-text-input id="password_confirmation" class="block w-full mt-1" type="password" name="password_confirmation" required autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>

                            <div class="mt-6">
                                <x-primary-button class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-blue-500 rounded-md hover:bg-blue-400 focus:outline-none focus:bg-blue-400 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                                    {{ __('Register') }}
                                </x-primary-button>
                            </div>
                        </form>
                        <p class="mt-6 text-sm text-center text-gray-400">Already have an account? <a href="{{ route('login') }}" class="text-blue-500 focus:outline-none focus:underline hover:underline">{{ __('Sign in') }}</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>