
<x-guest-layout >

    <!-- Estado de Sesión -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Dirección de Correo Electrónico -->
        <div>
            <x-input-label for="email" :value="__('Correo Electrónico')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Contraseña -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Recordarme -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Recordarme') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-center mt-4 flex-grow">
            <x-primary-button class="flex-grow justify-center" style="background-color: #063a8a;color:#FFD700">
                {{ __('Iniciar Sesión') }}
            </x-primary-button>
        </div>
    </form>

     <!-- Enlace para registrarse -->
     <div class="flex items-center justify-center mt-4">
        <a href="{{ url('/contacto') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
            {{ __('¿No tienes una cuenta? Regístrate aquí') }}
        </a>
    </div>


    <div class="flex items-center justify-center mt-4 flex-grow" style="background-color: #FFD700;color:#063a8a">
        <a href="{{ url('/contacto') }}" class="flex-grow justify-center">
            
        </a>
    </div>

    <a href="https://www.tienda.dimeqro.com" target="_blank" style=" background-color: #ffe600; color: #333; 
          padding: 10px 15px; border-radius: 50px; font-weight: bold; font-size: 14px;
          display: flex; align-items: center; text-decoration: none; box-shadow: 2px 2px 10px rgba(0,0,0,0.2);">
    <img src="https://www.expoknews.com/wp-content/uploads/2020/03/1200px-MercadoLibre.svg-1.png" alt="Mercado Libre" style="height: 30px; margin-right: 8px;">
    Comprar desde Mercado Libre
</a>

   

   
    

    <!-- Enlace para olvidaste tu contraseña -->
    @if (Route::has('password.request'))
        <!--div class="flex items-center justify-center mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100" href="{{ route('password.request') }}">
                {{ __('¿Olvidaste tu contraseña?') }}
            </a>
        </!--div-->
    @endif
</x-guest-layout>
