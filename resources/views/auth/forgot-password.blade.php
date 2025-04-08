<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3B82F6',
                        secondary: '#6366F1',
                        accent: '#10B981'
                    },
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

    <div class="max-w-md w-full bg-white p-8 rounded-2xl shadow-2xl text-gray-800 animate-slideUp">
        <h2 class="text-3xl font-extrabold text-center text-blue-600 mb-6 animate-bounce">¿Olvidaste tu contraseña?</h2>

        <p class="text-center text-sm text-gray-600 mb-4">No te preocupes. Haz clic en el botón para regresar al inicio de sesión.</p>

        <form onsubmit="event.preventDefault(); window.location.href='{{ route('login') }}';" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Correo electrónico</label>
                <input type="email" name="email" id="email" required placeholder="ejemplo@correo.com"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition-transform transform hover:scale-105 shadow-sm">
            </div>

            <button type="submit"
                class="w-full bg-gradient-to-r from-blue-500 to-purple-500 text-white font-medium px-6 py-3 rounded-lg shadow-md transition-transform transform hover:scale-105 hover:shadow-xl">
                Enviar enlace de recuperación
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="text-blue-500 hover:underline text-sm">Volver al inicio de sesión</a>
        </div>
    </div>

</body>
</html>
