
    <header class="mb-3">
        <h2 class="fw-bold text-dark">
            Información del Perfil
        </h2>
        <p class="text-muted">
            Actualiza la información de tu perfil y dirección de correo electrónico.
        </p>
    </header>

    <!-- Formulario de Envío de Verificación -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Formulario de Actualización del Perfil -->
    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <!-- Nombre -->
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Correo Electrónico -->
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror

            <!-- Si el usuario necesita verificar su correo -->
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-muted">
                        Tu dirección de correo electrónico no está verificada.
                        <button form="send-verification" class="btn btn-link p-0 text-primary">
                            Haz clic aquí para reenviar el correo de verificación.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <div class="alert alert-success mt-2">
                            Se ha enviado un nuevo enlace de verificación a tu correo electrónico.
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <!-- Botón Guardar y Mensaje de Éxito -->
        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">Guardar</button>
            
            @if (session('status') === 'profile-updated')
                <div class="alert alert-success mb-0" id="profile-updated-message">Guardado correctamente.</div>
                <script>
                    setTimeout(() => {
                        document.getElementById('profile-updated-message').style.display = 'none';
                    }, 2000);
                </script>
            @endif
        </div>
    </form>
    <br><br><br>