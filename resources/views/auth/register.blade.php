<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-black" />
            <x-text-input id="name" class="block mt-1 w-full text-black border-gray-300" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-black" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-black" />
            <x-text-input id="email" class="block mt-1 w-full text-black border-gray-300" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-black" />
        </div>

        <!-- Role (Radio) -->
        <div class="md:col-span-2 mt-4">
            <x-input-label :value="__('Role')" class="text-black mb-2" />
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                @foreach (\App\Enums\UserRole::cases() as $role)
                    @if ($role->value !== 'admin')
                        <label class="inline-flex items-center text-black">
                            <input type="radio" name="role" value="{{ $role->value }}" class="form-radio text-yellow-400 border-gray-300 focus:ring-yellow-400"
                                {{ old('role') == $role->value ? 'checked' : '' }} required>
                            <span class="ml-2">{{ ucfirst($role->value) }}</span>
                        </label>
                    @endif
                @endforeach
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2 text-black" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-black" />
            <x-text-input id="password" class="block mt-1 w-full text-black border-gray-300"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-black" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-black" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full text-black border-gray-300"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-black" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-black hover:text-yellow-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-400" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <button type="submit" class="ms-4 px-4 py-2 bg-yellow-400 text-black font-semibold rounded hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                {{ __('Register') }}
            </button>
        </div>
    </form>
</x-guest-layout>
