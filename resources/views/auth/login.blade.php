<!-- resources/views/auth/login.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="max-w-md mx-auto mt-12 bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center mb-6">Iniciar sesión</h2>

        <!-- Errores de validación -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-4 rounded-lg mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                <input type="email" name="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input type="password" name="password" id="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white px-6 py-3 rounded-lg">Iniciar sesión</button>
        </form>
    </div>

</body>
</html>
