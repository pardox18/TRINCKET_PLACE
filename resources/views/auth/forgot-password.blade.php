<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-500 flex items-center justify-center min-h-screen text-white">

    <div class="max-w-md w-full bg-white p-6 rounded-2xl shadow-lg text-gray-800 animate-fadeIn">
        <h2 class="text-3xl font-bold text-center mb-6">Recuperar Contraseña</h2>
        
        @if (session('status'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">
                {{ session('status') }}
            </div>
        @endif
        
        <form action="{{ route('password.email') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                <input type="email" name="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition-transform transform hover:scale-105" required>
            </div>
            
            <button type="submit" class="w-full bg-blue-500 text-white px-6 py-3 rounded-lg shadow-md transition-transform transform hover:scale-105 hover:shadow-xl">Enviar enlace de recuperación</button>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ url('login') }}" class="text-blue-600 hover:underline">Volver al inicio de sesión</a>
        </div>
    </div>
</body>
</html>
