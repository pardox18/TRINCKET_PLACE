<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto - Trincket Place</title>
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
            <form action="#" method="GET" class="relative">
                <input type="text" name="search" placeholder="Buscar productos..."
                    class="w-64 px-4 py-2 bg-blue-100 text-blue-900 border border-blue-300 rounded-full focus:ring-2 focus:ring-blue-400 placeholder-blue-500">
                <button type="submit" class="absolute right-3 top-2 text-blue-500 hover:text-blue-700">
                    🔍
                </button>
            </form>
            <p class="text-blue-700 font-semibold">👤 Invitado</p>
            <a href="{{ route('home') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 hover:scale-105 transition-transform"> Inicio</a>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="max-w-2xl w-full bg-white p-6 rounded-2xl shadow-lg text-gray-800 mt-10 animate-slideUp">
        <h2 class="text-3xl font-bold text-center text-blue-600">🎨 Pintura Retrato</h2>
        <img src="/images/producto4.jpg" alt="Pintura Retrato" class="w-full rounded-lg mt-4">
        <p class="text-lg mt-4">Retratos pintados a mano con gran detalle y calidad artística.</p>
        <p class="text-red-500 font-bold text-xl mt-2">$50.000</p>
        <button class="w-full bg-green-500 text-white px-4 py-2 rounded-lg mt-4 hover:bg-green-600 transition-transform transform hover:scale-105 hover:shadow-xl">
            Agregar al Carrito
        </button>
    </div>

    <!-- Sugerencias de otras pinturas -->
    <div class="max-w-3xl w-full bg-white p-6 rounded-2xl shadow-lg text-gray-800 mt-10 animate-fadeIn">
        <h2 class="text-2xl font-bold text-center text-blue-600 mb-4">🎨 Otras pinturas que podrían gustarte</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
            <div class="bg-gray-100 p-4 text-center rounded-xl shadow-md hover:shadow-xl hover:scale-105 transition-transform">
                <img src="/images/pintura1.jpg" class="mx-auto rounded-md h-40 object-cover">
                <p class="mt-2 font-bold">Pintura abstracta</p>
                <p class="text-red-500 font-bold text-lg">$45.000</p>
                <button class="bg-green-500 text-white px-3 py-1 rounded-lg mt-2 hover:bg-green-600">Agregar al Carrito</button>
            </div>
            <div class="bg-gray-100 p-4 text-center rounded-xl shadow-md hover:shadow-xl hover:scale-105 transition-transform">
                <img src="/images/pintura2.jpg" class="mx-auto rounded-md h-40 object-cover">
                <p class="mt-2 font-bold">Paisaje al óleo</p>
                <p class="text-red-500 font-bold text-lg">$55.000</p>
                <button class="bg-green-500 text-white px-3 py-1 rounded-lg mt-2 hover:bg-green-600">Agregar al Carrito</button>
            </div>
            <div class="bg-gray-100 p-4 text-center rounded-xl shadow-md hover:shadow-xl hover:scale-105 transition-transform">
                <img src="/images/pintura3.jpg" class="mx-auto rounded-md h-40 object-cover">
                <p class="mt-2 font-bold">Retrato al carboncillo</p>
                <p class="text-red-500 font-bold text-lg">$40.000</p>
                <button class="bg-green-500 text-white px-3 py-1 rounded-lg mt-2 hover:bg-green-600">Agregar al Carrito</button>
            </div>
        </div>
    </div>

</body>
</html>
