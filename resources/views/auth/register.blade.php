<!-- resources/views/auth/register.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse - Trincket Place</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-50 via-blue-100 to-blue-200 text-gray-800">

    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-lg">
            <h2 class="text-3xl font-bold text-center text-blue-600 mb-8">Registrarse</h2>

            <!-- Errores de validación -->
            @if ($errors->any())
                <div class="bg-red-100 text-red-600 p-4 rounded-lg mb-6">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('register') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre completo</label>
                    <input type="text" name="name" id="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                    <input type="email" name="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div class="mb-5">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                    <input type="password" name="password" id="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div class="mb-8">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmar contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300">Registrarse</button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">¿Ya tienes una cuenta? 
                    <a href="{{ url('login') }}" class="text-blue-600 hover:underline">Inicia sesión aquí</a>.
                </p>
            </div>
        </div>
    </div>

</body>
</html>
