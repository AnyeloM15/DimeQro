
    <header class="mb-3">
        <h2 class="text-lg fw-bold text-dark">
            Actualizar Contraseña
        </h2>
        <p class="text-muted">
            Asegúrate de usar una contraseña larga y segura para proteger tu cuenta.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <!-- Contraseña Actual -->
        <div class="mb-3">
            <label for="update_password_current_password" class="form-label">Contraseña Actual</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password">
            @error('current_password')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Nueva Contraseña -->
        <div class="mb-3">
            <label for="update_password_password" class="form-label">Nueva Contraseña</label>
            <input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password">
            @error('password')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirmar Nueva Contraseña -->
        <div class="mb-3">
            <label for="update_password_password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
            @error('password_confirmation')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Botón de Guardar y Mensaje de Éxito -->
        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">Guardar</button>
            
            @if (session('status') === 'password-updated')
                <p class="text-success mb-0" id="password-updated-message">Guardado correctamente.</p>
                <script>
                    setTimeout(() => {
                        document.getElementById('password-updated-message').style.display = 'none';
                    }, 2000);
                </script>
            @endif
        </div>
    </form>
