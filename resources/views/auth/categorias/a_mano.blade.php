<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hecho a Mano - Trincket Place</title>
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
                <input type="text" name="search" placeholder="Buscar artesanías..."
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

    <!-- Sección de Hecho a Mano -->
    <div class="max-w-5xl w-full bg-white p-6 rounded-2xl shadow-lg text-gray-800 mt-10 animate-slideUp">
        <h2 class="text-3xl font-bold text-center text-blue-600">🎨 Hecho a Mano</h2>
        <p class="text-lg text-center text-gray-600">Descubre nuestra colección de productos artesanales únicos.</p>

        <!-- Lista de productos hechos a mano -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            @php
                $hecho_a_mano = [
                    ['img' => 'pulsera1.jpg', 'nombre' => 'Pulsera de Cuentas', 'descripcion' => 'Pulsera artesanal hecha con piedras naturales.', 'precio' => '$15.000'],
                    ['img' => 'cuadro1.jpg', 'nombre' => 'Pintura en Lienzo', 'descripcion' => 'Arte hecho a mano con colores vibrantes.', 'precio' => '$80.000'],
                    ['img' => 'madera1.jpg', 'nombre' => 'Escultura de Madera', 'descripcion' => 'Escultura tallada a mano con detalles únicos.', 'precio' => '$120.000'],
                    ['img' => 'ceramica1.jpg', 'nombre' => 'Jarrón de Cerámica', 'descripcion' => 'Jarrón hecho y pintado a mano.', 'precio' => '$60.000'],
                    ['img' => 'tejido1.jpg', 'nombre' => 'Bolso Tejido', 'descripcion' => 'Bolso artesanal tejido con materiales ecológicos.', 'precio' => '$45.000'],
                    ['img' => 'collar1.jpg', 'nombre' => 'Collar de Macramé', 'descripcion' => 'Collar hecho a mano con hilo de algodón.', 'precio' => '$25.000'],
                ];
            @endphp

            @foreach($hecho_a_mano as $item)
                <div class="bg-gray-100 p-4 text-center rounded-xl shadow-md hover:shadow-xl hover:scale-105 transition-transform">
                    <img src="/images/{{ $item['img'] }}" class="mx-auto rounded-md h-40 object-cover">
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
