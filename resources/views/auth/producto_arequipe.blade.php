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
<body class="bg-blue-500 flex flex-col items-center min-h-screen text-white">
@auth
    <!-- Encabezado -->
    <div class="w-full bg-white shadow-md py-4 px-6 flex justify-between items-center animate-slideUp">
        <h1 class="text-3xl font-bold text-blue-600">Trincket Place</h1>
        <div class="flex items-center gap-4">
            <!-- Barra de búsqueda -->
            <form action="{{ route('products.index') }}" method="GET" class="relative">
                <input type="text" name="search" placeholder="Buscar productos..."
                    class="w-64 px-4 py-2 bg-blue-100 text-blue-900 border border-blue-300 rounded-full focus:ring-2 focus:ring-blue-400 placeholder-blue-500">
                <button type="submit" class="absolute right-3 top-2 text-blue-500 hover:text-blue-700">🔍</button>
            </form>

            <!-- Usuario actual -->
            <p class="text-blue-700 font-semibold">👤 {{ Auth::user()->name ?? 'Invitado' }}</p>

            <!-- Botón inicio -->
            <a href="{{ route('index') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 hover:scale-105 transition-transform">Inicio</a>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="max-w-2xl w-full bg-white p-6 rounded-2xl shadow-lg text-gray-800 mt-10 animate-slideUp">
        <h2 class="text-3xl font-bold text-center text-blue-600">🍮 Arequipe artesanal</h2>
        <img src="/images/producto2.jpg" alt="Arequipe artesanal" class="w-full rounded-lg mt-4">
        <p class="text-lg mt-4">Delicioso arequipe hecho a mano con ingredientes naturales y sin conservantes.</p>
        <p class="text-red-500 font-bold text-xl mt-2">$10.000</p>
        <form action="{{ route('carrito.agregar', ['id' => 2]) }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded-lg mt-4 hover:bg-green-600 transition-transform transform hover:scale-105 hover:shadow-xl">
                Agregar al Carrito
            </button>
        </form>
    </div>

    <!-- Sugerencias -->
    <div class="max-w-3xl w-full bg-white p-6 rounded-2xl shadow-lg text-gray-800 mt-10 animate-fadeIn">
        <h2 class="text-2xl font-bold text-center text-blue-600 mb-4">🍯 Otros arequipes que podrían gustarte</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
            @php
                $otrosArequipes = [
                    ['id' => 3, 'img' => 'arequipe2.jpg', 'nombre' => 'Arequipe con chocolate', 'precio' => '$12.000'],
                    ['id' => 4, 'img' => 'arequipe3.jpg', 'nombre' => 'Arequipe sin azúcar', 'precio' => '$11.000'],
                    ['id' => 5, 'img' => 'arequipe4.jpg', 'nombre' => 'Arequipe con coco', 'precio' => '$13.000'],
                    ['id' => 6, 'img' => 'arequipe5.jpg', 'nombre' => 'Arequipe premium', 'precio' => '$15.000'],
                    ['id' => 7, 'img' => 'arequipe6.jpg', 'nombre' => 'Arequipe con almendras', 'precio' => '$14.000'],
                    ['id' => 8, 'img' => 'arequipe7.jpg', 'nombre' => 'Arequipe tradicional', 'precio' => '$10.000'],
                ];
            @endphp

            @foreach($otrosArequipes as $item)
                <div class="bg-gray-100 p-4 text-center rounded-xl shadow-md hover:shadow-xl hover:scale-105 transition-transform">
                    <img src="/images/{{ $item['img'] }}" class="mx-auto rounded-md h-40 object-cover">
                    <p class="mt-2 font-bold">{{ $item['nombre'] }}</p>
                    <p class="text-red-500 font-bold text-lg">{{ $item['precio'] }}</p>
                    <form action="{{ route('carrito.agregar', ['id' => $item['id']]) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded-lg mt-2 hover:bg-green-600">
                            Agregar al Carrito
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@else
    <!-- Acceso restringido -->
    <div class="container mx-auto mt-6 p-6 bg-white shadow-lg rounded-lg text-center text-gray-800 animate-fadeIn">
        <h2 class="text-3xl font-bold text-red-600">Acceso Restringido</h2>
        <p class="text-lg mt-4">Debes iniciar sesión para ver este contenido.</p>
        <a href="{{ route('login') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg mt-4 hover:bg-blue-600">Iniciar Sesión</a>
    </div>
@endauth
</body>
</html>
