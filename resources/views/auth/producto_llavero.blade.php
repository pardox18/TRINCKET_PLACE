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
            <a href="{{ route('home') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 hover:scale-105 transition-transform">Inicio</a>
        </div>
    </div>

    <!-- Contenido del llavero principal -->
    <div class="max-w-2xl w-full bg-white p-6 rounded-2xl shadow-lg text-gray-800 mt-10 animate-slideUp">
        <h2 class="text-3xl font-bold text-center text-blue-600">🔑 Llaveros hechos a mano</h2>
        <img src="/images/producto3.jpg" alt="Llaveros hechos a mano" class="w-full rounded-lg mt-4">
        <p class="text-lg mt-4">Hermosos llaveros artesanales diseñados con materiales de alta calidad.</p>
        <p class="text-red-500 font-bold text-xl mt-2">$15.000</p>
        <button class="w-full bg-green-500 text-white px-4 py-2 rounded-lg mt-4 hover:bg-green-600 transition-transform transform hover:scale-105 hover:shadow-xl">
            Agregar al Carrito
        </button>
    </div>

    <!-- Sugerencias de otros llaveros -->
    <div class="max-w-3xl w-full bg-white p-6 rounded-2xl shadow-lg text-gray-800 mt-10 animate-fadeIn">
        <h2 class="text-2xl font-bold text-center text-blue-600 mb-4">🔑 Otros llaveros que podrían gustarte</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
            @php
                $otrosLlaveros = [
                    ['img' => 'llavero1.jpg', 'nombre' => 'Llavero de cuero', 'precio' => '$18.000'],
                    ['img' => 'llavero2.jpg', 'nombre' => 'Llavero personalizado', 'precio' => '$20.000'],
                    ['img' => 'llavero3.jpg', 'nombre' => 'Llavero de madera', 'precio' => '$17.000'],
                    ['img' => 'llavero4.jpg', 'nombre' => 'Llavero metálico', 'precio' => '$22.000'],
                    ['img' => 'llavero5.jpg', 'nombre' => 'Llavero con inicial', 'precio' => '$19.000'],
                    ['img' => 'llavero6.jpg', 'nombre' => 'Llavero artesanal', 'precio' => '$16.000'],
                ];
            @endphp

            @foreach($otrosLlaveros as $llavero)
                <div class="bg-gray-100 p-4 text-center rounded-xl shadow-md hover:shadow-xl hover:scale-105 transition-transform">
                    <img src="/images/{{ $llavero['img'] }}" class="mx-auto rounded-md h-40 object-cover">
                    <p class="mt-2 font-bold">{{ $llavero['nombre'] }}</p>
                    <p class="text-red-500 font-bold text-lg">{{ $llavero['precio'] }}</p>
                    <button class="bg-green-500 text-white px-3 py-1 rounded-lg mt-2 hover:bg-green-600">Agregar al Carrito</button>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>
