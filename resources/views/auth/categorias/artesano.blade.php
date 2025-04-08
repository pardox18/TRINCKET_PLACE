<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artesano - Trincket Place</title>
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
            <!-- Barra de búsqueda -->
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                <input type="text" name="search" placeholder="Buscar artesanos..."
                    class="w-64 px-4 py-2 bg-blue-100 text-blue-900 border border-blue-300 rounded-full focus:ring-2 focus:ring-blue-400 placeholder-blue-500">
                <button type="submit" class="absolute right-3 top-2 text-blue-500 hover:text-blue-700">
                    🔍
                </button>
            </form>

            <!-- Nombre de usuario -->
            <p class="text-blue-700 font-semibold">👤 {{ Auth::user()->name ?? 'Invitado' }}</p>

            <!-- Botón de inicio -->
            <a href="{{ route('home') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 hover:scale-105 transition-transform">Inicio</a>
        </div>
    </div>

    <!-- Sección de Artesanos -->
    <div class="max-w-5xl w-full bg-white p-6 rounded-2xl shadow-lg text-gray-800 mt-10 animate-slideUp">
        <h2 class="text-3xl font-bold text-center text-blue-600">🛠️ Artesanos</h2>
        <p class="text-lg text-center text-gray-600">Explora los productos únicos hechos por nuestros artesanos.</p>

        <!-- Lista de productos de artesanos -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
        @php
    $artesanos = [
        ['img' => 'images/122/figura_tallada.jpg', 'nombre' => 'Figura Tallada', 'descripcion' => 'Figura de madera tallada a mano.', 'precio' => '$75.000'],
        ['img' => 'images/122/billetera.webp', 'nombre' => 'Billetera de Cuero', 'descripcion' => 'Billetera artesanal de cuero genuino.', 'precio' => '$50.000'],
        ['img' => 'images/122/cesta.jpg', 'nombre' => 'Cesta Tejida', 'descripcion' => 'Cesta hecha a mano con fibras naturales.', 'precio' => '$40.000'],
        ['img' => 'images/122/anillo_plata.webp', 'nombre' => 'Anillo de Plata', 'descripcion' => 'Anillo artesanal hecho con plata pura.', 'precio' => '$120.000'],
        ['img' => 'images/122/plato_ceramica.webp', 'nombre' => 'Plato de Cerámica', 'descripcion' => 'Plato decorativo hecho y pintado a mano.', 'precio' => '$35.000'],
        ['img' => 'images/122/bufanta.avif', 'nombre' => 'Bufanda Tejida', 'descripcion' => 'Bufanda artesanal hecha con lana de alpaca.', 'precio' => '$60.000'],
    ];
@endphp

            @foreach($artesanos as $item)
                <div class="bg-gray-100 p-4 text-center rounded-xl shadow-md hover:shadow-xl hover:scale-105 transition-transform">
                <img src="{{ asset($item['img']) }}" class="mx-auto rounded-md h-40 object-cover">
                <p class="mt-2 font-bold text-lg">{{ $item['nombre'] }}</p>
                    <p class="text-gray-600 text-sm">{{ $item['descripcion'] }}</p>
                    <p class="text-red-500 font-bold text-lg mt-2">{{ $item['precio'] }}</p>
                    <button class="bg-green-500 text-white px-3 py-1 rounded-lg mt-2 hover:bg-green-600 transition-transform hover:scale-105">
                        Agregar al Carrito
                    </button>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>
