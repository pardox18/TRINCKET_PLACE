<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arequipe Artesanal - Trincket Place</title>
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
<body class="bg-blue-100 min-h-screen text-gray-800">
    @auth
    <!-- Encabezado -->
    <header class="bg-white shadow-md py-4 px-6 flex justify-between items-center animate-slideUp">
        <h1 class="text-2xl font-bold text-blue-600">Trincket Place</h1>
        <nav class="flex gap-4 items-center">
            <form action="{{ route('products.index') }}" method="GET" class="relative">
                <input type="text" name="search" placeholder="Buscar productos..."
                       class="w-60 px-4 py-2 rounded-full bg-blue-50 border border-blue-300 text-sm placeholder-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-400">
                <button type="submit" class="absolute right-3 top-2 text-blue-600">🔍</button>
            </form>
            <span class="text-blue-700">👤 {{ Auth::user()->name }}</span>
            <a href="{{ route('index') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition">Inicio</a>
        </nav>
    </header>

    <!-- Producto principal -->
    <main class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-2xl shadow-xl animate-fadeIn">
        <h2 class="text-3xl font-bold text-center text-blue-600">🍯 Arequipe Artesanal</h2>
        <img src="{{ asset('images/122/arequipe.webp') }}" alt="Arequipe Artesanal"
             class="mx-auto h-24 w-24 object-cover rounded-xl mt-4" loading="lazy">
        <p class="text-lg mt-4">Delicioso arequipe artesanal, preparado con ingredientes de la mejor calidad.</p>
        <p class="text-xl font-bold text-red-500 mt-2">$12.000</p>

        <form action="{{ route('carrito.agregar', 9) }}" method="POST" class="mt-4">
            @csrf
            <input type="hidden" name="name" value="Arequipe Artesanal">
            <input type="hidden" name="price" value="12000">
            <input type="hidden" name="image_url" value="{{ asset('images/arequipe.webp') }}">
            <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded-lg shadow-md hover:scale-105 transition-all">
                Agregar al Carrito
            </button>
        </form>
    </main>

    <!-- Sugerencias -->
    <section class="max-w-5xl mx-auto mt-10 bg-white p-6 rounded-2xl shadow-lg animate-fadeIn">
        <h3 class="text-2xl font-bold text-blue-600 mb-4 text-center">🍯 Otros productos que podrían gustarte</h3>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
            @php
                $otrosProductos = [
                    ['id' => 10, 'img' => 'arequipe.jpg', 'nombre' => 'Arequipe de vainilla', 'precio' => '$13.000'],
                    ['id' => 11, 'img' => 'arequipe2.webp', 'nombre' => 'Arequipe de chocolate', 'precio' => '$14.000'],
                    ['id' => 12, 'img' => 'arequipe3.webp', 'nombre' => 'Arequipe con nuez', 'precio' => '$15.000'],
                    ['id' => 13, 'img' => 'arequipe4.webp', 'nombre' => 'Arequipe natural', 'precio' => '$11.000'],
                    ['id' => 14, 'img' => 'arequipe5.webp', 'nombre' => 'Arequipe light', 'precio' => '$12.500'],
                    ['id' => 15, 'img' => 'arequipe6.jpg', 'nombre' => 'Arequipe sin azúcar', 'precio' => '$13.500'],
                ];
            @endphp

            @foreach($otrosProductos as $producto)
                @php
                    $precioNumerico = preg_replace('/[^0-9]/', '', $producto['precio']);
                @endphp
                <div class="bg-blue-50 p-4 rounded-xl shadow hover:shadow-xl hover:scale-105 transition">
                    <img src="{{ asset('images/122/' . $producto['img']) }}" alt="{{ $producto['nombre'] }}" class="w-full h-40 object-cover rounded-md" loading="lazy">
                    <p class="mt-2 font-semibold">{{ $producto['nombre'] }}</p>
                    <p class="text-red-500 font-bold text-lg">{{ $producto['precio'] }}</p>
                    <form action="{{ route('carrito.agregar', $producto['id']) }}" method="POST">
                        @csrf
                        <input type="hidden" name="name" value="{{ $producto['nombre'] }}">
                        <input type="hidden" name="price" value="{{ $precioNumerico }}">
                        <input type="hidden" name="image_url" value="{{ asset('images/122/' . $producto['img']) }}">
                        <button type="submit" class="mt-2 w-full bg-green-500 hover:bg-green-600 text-white py-1.5 rounded-lg transition-all">
                            Agregar al Carrito
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </section>
    @else
    <!-- Acceso restringido -->
    <section class="max-w-xl mx-auto mt-20 p-6 bg-white shadow-lg rounded-lg text-center animate-fadeIn">
        <h2 class="text-3xl font-bold text-red-600">Acceso Restringido</h2>
        <p class="text-lg mt-4">Debes iniciar sesión para ver este contenido.</p>
        <a href="{{ route('login') }}" class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">Iniciar Sesión</a>
    </section>
    @endauth
</body>
</html>
