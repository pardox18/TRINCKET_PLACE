<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        fadeIn: "fadeIn 0.5s ease-in-out",
                        bounce: "bounce 1s infinite",
                        slideUp: "slideUp 0.6s ease-out"
                    },
                    keyframes: {
                        fadeIn: {
                            "0%": { opacity: "0" },
                            "100%": { opacity: "1" }
                        },
                        slideUp: {
                            "0%": { opacity: "0", transform: "translateY(50px)" },
                            "100%": { opacity: "1", transform: "translateY(0)" }
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-blue-100 flex items-center justify-center min-h-screen text-white">

    <div class="max-w-md w-full bg-white p-6 rounded-2xl shadow-lg text-gray-800 animate-slideUp">
        <h2 class="text-3xl font-bold text-center mb-6 animate-bounce">Iniciar sesión</h2>

        <!-- Errores de validación -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-4 rounded-lg mb-4 animate-fadeIn">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                <input type="email" name="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition-transform transform hover:scale-105" required>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input type="password" name="password" id="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition-transform transform hover:scale-105" required>
            </div>

            <a href="{{ route('password.request') }}" class="block text-sm text-blue-500 hover:underline text-center">¿Olvidaste tu contraseña?</a>
            
            <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-purple-500 text-white px-6 py-3 rounded-lg shadow-md transition-transform transform hover:scale-105 hover:shadow-xl">Iniciar sesión</button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-gray-700">Aún no tienes cuenta?</p>
            <p class="text-gray-900 font-bold">Únete al mejor lugar de ventas de emprendimientos</p>
            <a href="{{ route('register') }}" class="mt-2 inline-block bg-green-500 text-white px-6 py-2 rounded-lg shadow-md transition-transform transform hover:scale-105 hover:shadow-xl">Registrarse</a>
        </div>
    </div>

</body>
</html>
