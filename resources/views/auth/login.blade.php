<x-guest-layout>
    <div class="fixed inset-0 w-full h-full bg-cover bg-center bg-no-repeat flex items-center justify-center" 
         style="background-image: url('{{ asset('images/banjirfoto2.jpg') }}');">
        
        <div class="absolute inset-0 bg-slate-900/50"></div>

        <div class="relative w-full max-w-md bg-white rounded-2xl p-10 mx-4 shadow-[0_0_50px_rgba(59,130,246,0.5)] border border-blue-200">

            <div class="text-center mb-8">
                <img
                    src="{{ asset('images/logo1.png') }}"
                    alt="FloodSense Logo"
                    class="mx-auto h-50 w-50 mb-4"
                >
                <p class="text-sm text-gray-500 font-medium">Aplikasi Pelaporan & Pemantauan Banjir</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-5">
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
                    <x-text-input 
                        id="email" 
                        class="block mt-1 w-full border-gray-200 focus:border-blue-500 focus:ring-blue-500 rounded-lg" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        required 
                        autofocus 
                        autocomplete="username" 
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-5">
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700" />
                    <x-text-input 
                        id="password" 
                        class="block mt-1 w-full border-gray-200 focus:border-blue-500 focus:ring-blue-500 rounded-lg"
                        type="password"
                        name="password"
                        required 
                        autocomplete="current-password" 
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between mt-6">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                        <span class="ms-2 text-sm text-gray-500">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-blue-600 hover:underline font-medium" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <div class="mt-8">
                    <x-primary-button class="w-full justify-center bg-[#2557a7] hover:bg-[#1e4687] py-3 rounded-lg text-white font-bold uppercase tracking-widest shadow-lg shadow-blue-200">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>

            <div class="mt-8 text-center text-sm text-gray-500">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-blue-700 font-bold hover:underline">
                    Daftar di sini
                </a>
            </div>

        </div>
    </div>
</x-guest-layout>