<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- userid -->
        <div>
            <x-input-label for="userid" :value="__('Όνομα χρήστη')" />
            <x-text-input id="userid" class="block mt-1 w-full" type="text" name="userid" :value="old('userid')" required autofocus autocomplete="userid" />
            <x-input-error :messages="$errors->get('userid')" class="mt-2" />
        </div>

        <!-- password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Κωδικός')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
{{--
        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div> --}}

        <div class="flex items-center justify-end mt-4">
            {{-- @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Ξεχασα τον κωδικόι μου') }}
                </a>
            @endif --}}

            <x-primary-button class="ms-3">
                {{ __('Εισοδος') }}
            </x-primary-button>
        </div>
    </form>
    @if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
</x-guest-layout>
