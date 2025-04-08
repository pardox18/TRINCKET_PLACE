<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accesorios - Trincket Place</title>
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
<body class="bg-blue-100 flex flex-col items-center min-h-screen text-white">

    <!-- Encabezado -->
    <div class="w-full bg-white shadow-md py-4 px-6 flex justify-between items-center animate-slideUp">
        <h1 class="text-3xl font-bold text-blue-600">Trincket Place</h1>

        <div class="flex items-center gap-4">
            <form action="{{ route('products.index') }}" method="GET" class="relative">
                <input type="text" name="search" placeholder="Buscar accesorios..."
                    class="w-64 px-4 py-2 bg-blue-100 text-blue-900 border border-blue-300 rounded-full focus:ring-2 focus:ring-blue-400 placeholder-blue-500">
                <button type="submit" class="absolute right-3 top-2 text-blue-500 hover:text-blue-700">🔍</button>
            </form>
            <p class="text-blue-700 font-semibold">👤 {{ Auth::user()->name ?? 'Invitado' }}</p>
            <a href="{{ route('index') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 hover:scale-105 transition-transform">Inicio</a>
        </div>
    </div>

    <!-- Sección de Accesorios -->
    <div class="max-w-5xl w-full bg-white p-6 rounded-2xl shadow-lg text-gray-800 mt-10 animate-slideUp">
        <h2 class="text-3xl font-bold text-center text-blue-600">🛍️ Accesorios</h2>
        <p class="text-lg text-center text-gray-600">Encuentra los mejores accesorios artesanales y modernos.</p>

        <!-- Lista de accesorios -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            @php
                $accesorios = [
                    ['id' => 21, 'img' => 'collarart.jpg', 'nombre' => 'Collar artesanal', 'descripcion' => 'Hecho a mano con piedras naturales.', 'precio' => '$20.000'],
                    ['id' => 22, 'img' => 'pulsera.jpg', 'nombre' => 'Pulsera de cuero', 'descripcion' => 'Pulsera ajustable con diseño único.', 'precio' => '$15.000'],
                    ['id' => 23, 'img' => 'anillo.jpg', 'nombre' => 'Anillo de plata', 'descripcion' => 'Diseño elegante en plata esterlina.', 'precio' => '$30.000'],
                    ['id' => 24, 'img' => 'aretes.jpg', 'nombre' => 'Aretes de perlas', 'descripcion' => 'Perlas naturales con montura dorada.', 'precio' => '$25.000'],
                    ['id' => 25, 'img' => 'gafas.avif', 'nombre' => 'Gafas de sol', 'descripcion' => 'Lentes con protección UV y marco de madera.', 'precio' => '$45.000'],
                    ['id' => 26, 'img' => 'ben.webp', 'nombre' => 'Reloj de super heroe', 'descripcion' => 'El mejor reloj para tener control del tiempo.', 'precio' => '$60.000'],
                ];
            @endphp

            @foreach($accesorios as $accesorio)
                <div class="bg-gray-100 p-4 text-center rounded-xl shadow-md hover:shadow-xl hover:scale-105 transition-transform">
                    <img src="{{ asset('images/122/' . $accesorio['img']) }}" alt="{{ $accesorio['nombre'] }}" class="mx-auto rounded-md h-40 object-cover" loading="lazy">
                    <p class="mt-2 font-bold text-lg">{{ $accesorio['nombre'] }}</p>
                    <p class="text-gray-600 text-sm">{{ $accesorio['descripcion'] }}</p>
                    <p class="text-red-500 font-bold text-lg mt-2">{{ $accesorio['precio'] }}</p>
                    <form action="{{ route('carrito.agregar', ['id' => $accesorio['id']]) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded-lg mt-2 hover:bg-green-600 transition-transform hover:scale-105 focus:outline-none">
                            Agregar al Carrito
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>
