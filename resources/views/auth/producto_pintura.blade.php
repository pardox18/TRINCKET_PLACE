<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pintura Retrato - Trincket Place</title>
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
<body class="bg-blue-100 text-gray-800 min-h-screen">
    @auth
    <!-- Encabezado -->
    <header class="bg-white shadow-md py-4 px-6 flex justify-between items-center animate-slideUp">
        <h1 class="text-3xl font-bold text-blue-600">Trincket Place</h1>
        <nav class="flex items-center gap-4">
            <form action="{{ route('products.index') }}" method="GET" class="relative">
                <input type="text" name="search" placeholder="Buscar productos..."
                       class="w-64 px-4 py-2 bg-blue-50 text-blue-900 border border-blue-300 rounded-full focus:ring-2 focus:ring-blue-400 placeholder-blue-500">
                <button type="submit" class="absolute right-3 top-2 text-blue-500 hover:text-blue-700">🔍</button>
            </form>
            <p class="text-blue-700 font-semibold">👤 {{ Auth::user()->name }}</p>
            <a href="{{ route('index') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 hover:scale-105 transition-transform">Inicio</a>
        </nav>
    </header>

    <!-- Producto Principal -->
    <main class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded-2xl shadow-xl animate-fadeIn">
        <h2 class="text-3xl font-bold text-center text-blue-600">🎨 Pintura Retrato</h2>
        <img src="{{ asset('images/mona.jpg') }}" alt="Pintura Retrato"
     class="mx-auto h-24 w-24 object-cover rounded-lg mt-4" loading="lazy">
        <p class="text-lg mt-4">Retratos pintados a mano con gran detalle y calidad artística.</p>
        <p class="text-xl font-bold text-red-500 mt-2">$50.000</p>

        <form action="{{ route('carrito.agregar', 16) }}" method="POST" class="mt-4">
            @csrf
            <input type="hidden" name="name" value="Pintura Retrato">
            <input type="hidden" name="price" value="50000">
            <input type="hidden" name="image_url" value="{{ asset('images/mona.jpg') }}">
            <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-transform transform hover:scale-105 hover:shadow-xl">
                Agregar al Carrito
            </button>
        </form>
    </main>

    <!-- Sugerencias -->
    <section class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-2xl shadow-lg animate-fadeIn">
        <h3 class="text-2xl font-bold text-center text-blue-600 mb-4">🎨 Otras pinturas que podrían gustarte</h3>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
            @php
                $pinturas = [
                    ['id' => 17, 'img' => 'abstracta.jpg', 'nombre' => 'Pintura abstracta', 'precio' => '$45.000'],
                    ['id' => 18, 'img' => 'paisajeole.jpg', 'nombre' => 'Paisaje al óleo', 'precio' => '$55.000'],
                    ['id' => 19, 'img' => 'carbon.jpg', 'nombre' => 'Retrato al carboncillo', 'precio' => '$40.000'],
                ];
            @endphp

            @foreach ($pinturas as $pintura)
                @php
                    $precioNumerico = preg_replace('/[^0-9]/', '', $pintura['precio']);
                @endphp
                <div class="bg-blue-50 p-4 text-center rounded-xl shadow-md hover:shadow-xl hover:scale-105 transition-transform">
                    <img src="{{ asset('images/122/' . $pintura['img']) }}" alt="{{ $pintura['nombre'] }}" class="mx-auto rounded-md h-40 object-cover" loading="lazy">
                    <p class="mt-2 font-semibold">{{ $pintura['nombre'] }}</p>
                    <p class="text-red-500 font-bold text-lg">{{ $pintura['precio'] }}</p>
                    <form action="{{ route('carrito.agregar', $pintura['id']) }}" method="POST">
                        @csrf
                        <input type="hidden" name="name" value="{{ $pintura['nombre'] }}">
                        <input type="hidden" name="price" value="{{ $precioNumerico }}">
                        <input type="hidden" name="image_url" value="{{ asset('images/122/' . $pintura['img']) }}">
                        <button type="submit" class="mt-2 w-full bg-green-500 text-white py-1.5 rounded-lg hover:bg-green-600 transition-all">
                            Agregar al Carrito
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </section>
    @else
    <!-- Si no está autenticado -->
    <section class="max-w-xl mx-auto mt-20 p-6 bg-white shadow-lg rounded-lg text-center animate-fadeIn">
        <h2 class="text-3xl font-bold text-red-600">Acceso Restringido</h2>
        <p class="text-lg mt-4">Debes iniciar sesión para ver este contenido.</p>
        <a href="{{ route('login') }}" class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">Iniciar Sesión</a>
    </section>
    @endauth
</body>
</html>
