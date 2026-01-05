<x-guest-layout>
    <div class="fixed inset-0 w-full h-full bg-cover bg-center bg-no-repeat flex items-center justify-center" 
         style="background-image: url('{{ asset('images/banjirfoto2.jpg') }}');">
        
        <div class="absolute inset-0 bg-slate-900/50"></div>

        <div class="relative w-full max-w-md bg-white rounded-2xl mx-4 shadow-[0_0_50px_rgba(59,130,246,0.5)] border border-blue-200 flex flex-col max-h-[90vh]">
            
            <div class="p-8 mb pb-0 text-center">
                <img
                    src="{{ asset('images/logo1.png') }}"
                    alt="FloodSense Logo"
                    class="mx-auto h-50 w-50 mb-3"
                >
                <h2 class="text-xl font-bold text-gray-800">Daftar Akun Baru</h2>
                <p class="text-sm text-gray-500 font-medium">Gabung bersama FloodSense</p>
            </div>

            <div class="p-8 pt-6 overflow-y-auto scrollbar-thin scrollbar-thumb-blue-200">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Name')" class="text-gray-700" />
                        <x-text-input 
                            id="name" 
                            class="block mt-1 w-full border-gray-200 focus:border-blue-500 focus:ring-blue-500 rounded-lg" 
                            type="text" 
                            name="name" 
                            :value="old('name')" 
                            required 
                            autofocus 
                            autocomplete="name" 
                        />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
                        <x-text-input 
                            id="email" 
                            class="block mt-1 w-full border-gray-200 focus:border-blue-500 focus:ring-blue-500 rounded-lg" 
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            required 
                            autocomplete="username" 
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="password" :value="__('Password')" class="text-gray-700" />
                        <x-text-input 
                            id="password" 
                            class="block mt-1 w-full border-gray-200 focus:border-blue-500 focus:ring-blue-500 rounded-lg"
                            type="password"
                            name="password"
                            required 
                            autocomplete="new-password" 
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700" />
                        <x-text-input 
                            id="password_confirmation" 
                            class="block mt-1 w-full border-gray-200 focus:border-blue-500 focus:ring-blue-500 rounded-lg"
                            type="password"
                            name="password_confirmation" 
                            required 
                            autocomplete="new-password" 
                        />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="mt-6">
                        <x-primary-button class="w-full justify-center bg-[#2557a7] hover:bg-[#1e4687] py-3 rounded-lg text-white font-bold uppercase tracking-widest shadow-lg shadow-blue-200 transition duration-300 transform hover:scale-[1.02]">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>

                <div class="mt-6 pb-2 text-center text-sm text-gray-500">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-blue-700 font-bold hover:underline">
                        {{ __('Already registered?') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>