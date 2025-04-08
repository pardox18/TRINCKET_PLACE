<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
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
<body class="bg-white flex flex-col items-center min-h-screen text-white">

    <!-- Barra Superior -->
    <div class="w-full bg-cyan-500 shadow-md py-4 px-6 flex justify-between items-center animate-slideUp">
        <h1 class="text-3xl font-bold text-white">Trincket Place</h1>

        <div class="flex items-center gap-4">
            <!-- Nombre de la sesión del usuario -->
            <p class="text-white font-semibold">👤 Administrador</p>

            <!-- Botón para volver al inicio -->
            <a href="{{ route('home') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 hover:scale-105 transition-transform">Inicio</a>
        </div>
    </div>

    <!-- Contenido -->
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-2xl shadow-lg mt-6 animate-slideUp">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Bienvenido al Panel de Administración</h1>

        <!-- Mostrar mensaje de error si no es administrador -->
        @if(session('error'))
            <div class="bg-red-100 text-red-600 p-4 rounded-lg mb-4 animate-fadeIn">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <!-- Mostrar lista de usuarios -->
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Usuarios Registrados:</h2>

        @if($usuarios->isEmpty())
            <p class="text-gray-600">No hay usuarios registrados.</p>
        @else
            <ul class="space-y-4">
                @foreach ($usuarios as $usuario)
                    <li class="flex justify-between items-center py-2 border-b border-gray-300">
                        <span class="text-gray-800">
                            {{ $usuario->name }} - {{ $usuario->email }} - 
                            Rol: 
                            @if($usuario->role === 'admin')
                                <span class="bg-blue-500 text-white px-3 py-1 rounded-full">Admin</span>
                            @else
                                <span class="bg-gray-600 text-white px-3 py-1 rounded-full">Usuario</span>
                            @endif
                        </span>
                        <!-- Fecha de unión -->
                        <span class="text-sm text-gray-600">
                            Desde: {{ $usuario->created_at->format('d/m/Y') }}
                        </span>
                        <!-- Botón de Eliminar cuenta -->
                        @if($usuario->role !== 'admin')  <!-- No permitir eliminar admins -->
                            <form action="{{ route('admin.delete', $usuario->id) }}" method="POST" class="inline-block ml-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-red-400 transition-transform transform hover:scale-105">Eliminar Cuenta</button>
                            </form>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif

        <!-- Botón de cierre de sesión -->
        <div class="mt-6 text-center">
            <a href="{{ route('logout') }}" class="bg-red-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-red-400 transition-transform transform hover:scale-105">Cerrar sesión</a>
        </div>
    </div>

</body>
</html>