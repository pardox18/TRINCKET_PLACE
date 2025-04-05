<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto</title>
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
<body class="bg-blue-500 flex flex-col items-center min-h-screen text-white">

    <!-- Encabezado -->
    <div class="w-full bg-white shadow-md py-4 px-6 flex justify-between items-center animate-slideUp">
        <h1 class="text-3xl font-bold text-blue-600">Trincket Place</h1>

        <div class="flex items-center gap-4">
            <!-- Barra de búsqueda -->
            <form action="{{ route('products.index') }}" method="GET" class="relative">
                <input type="text" name="search" placeholder="Buscar productos..."
                    class="w-64 px-4 py-2 bg-blue-100 text-blue-900 border border-blue-300 rounded-full focus:ring-2 focus:ring-blue-400 placeholder-blue-500">
                <button type="submit" class="absolute right-3 top-2 text-blue-500 hover:text-blue-700">
                    🔍
                </button>
            </form>

            <!-- Nombre de la sesión del usuario -->
            <p class="text-blue-700 font-semibold">👤 {{ Auth::user()->name ?? 'Invitado' }}</p>

            <!-- Botón para volver al inicio -->
            <a href="{{ route('home') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 hover:scale-105 transition-transform"> Inicio</a>
        </div>
    </div>

    <!-- Contenido -->
    <div class="max-w-2xl w-full bg-white p-6 rounded-2xl shadow-lg text-gray-800 mt-10 animate-slideUp">
        <h2 class="text-3xl font-bold text-center text-blue-600">👜 Bolso hecho a mano</h2>
        <img src="/images/producto1.jpg" alt="Bolso hecho a mano" class="w-full rounded-lg mt-4">
        <p class="text-lg mt-4">Bolso artesanal de alta calidad, ideal para cualquier ocasión.</p>
        <p class="text-red-500 font-bold text-xl mt-2">$40.000</p>
        <button class="w-full bg-green-500 text-white px-4 py-2 rounded-lg mt-4 hover:bg-green-600 transition-transform transform hover:scale-105 hover:shadow-xl">
            Agregar al Carrito
        </button>
    </div>

    <!-- Sugerencias de otros bolsos -->
    <div class="max-w-3xl w-full bg-white p-6 rounded-2xl shadow-lg text-gray-800 mt-10 animate-fadeIn">
        <h2 class="text-2xl font-bold text-center text-blue-600 mb-4">👜 Otros bolsos que podrían gustarte</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
            @php
                $otrosBolsos = [
                    ['img' => 'bolso2.jpg', 'nombre' => 'Bolso Casual', 'precio' => '$35.000'],
                    ['img' => 'bolso3.jpg', 'nombre' => 'Bolso de Cuero', 'precio' => '$50.000'],
                    ['img' => 'bolso4.jpg', 'nombre' => 'Bolso Vintage', 'precio' => '$45.000'],
                    ['img' => 'bolso5.jpg', 'nombre' => 'Bolso Moderno', 'precio' => '$38.000'],
                    ['img' => 'bolso6.jpg', 'nombre' => 'Bolso de Tela', 'precio' => '$28.000'],
                    ['img' => 'bolso7.jpg', 'nombre' => 'Bolso Deportivo', 'precio' => '$42.000'],
                ];
            @endphp

            @foreach($otrosBolsos as $bolso)
                <div class="bg-gray-100 p-4 text-center rounded-xl shadow-md hover:shadow-xl hover:scale-105 transition-transform">
                    <img src="/images/{{ $bolso['img'] }}" class="mx-auto rounded-md h-40 object-cover">
                    <p class="mt-2 font-bold">{{ $bolso['nombre'] }}</p>
                    <p class="text-red-500 font-bold text-lg">{{ $bolso['precio'] }}</p>
                    <button class="bg-green-500 text-white px-3 py-1 rounded-lg mt-2 hover:bg-green-600">Agregar al Carrito</button>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>
