<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bolso - Detalles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        fadeIn: "fadeIn 0.5s ease-in-out",
                        slideUp: "slideUp 0.6s ease-out",
                        bounce: "bounce 1s infinite"
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
    <header class="w-full bg-white shadow-md py-4 px-6 flex justify-between items-center animate-slideUp">
        <h1 class="text-3xl font-bold text-blue-600">Trincket Place</h1>

        <div class="flex items-center gap-4">
            <form action="{{ route('products.index') }}" method="GET" class="relative">
                <input type="text" name="search" placeholder="Buscar productos..."
                       class="w-64 px-4 py-2 bg-blue-100 text-blue-900 border border-blue-300 rounded-full focus:ring-2 focus:ring-blue-400 placeholder-blue-500">
                <button type="submit" class="absolute right-3 top-2 text-blue-500 hover:text-blue-700">🔍</button>
            </form>

            <p class="text-blue-700 font-semibold">👤 {{ Auth::user()->name ?? 'Invitado' }}</p>

            <a href="{{ route('index') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 hover:scale-105 transition-transform">
                Inicio
            </a>
        </div>
    </header>

    <!-- Detalle del producto -->
    <main class="max-w-2xl w-full bg-white p-6 rounded-2xl shadow-lg text-gray-800 mt-10 animate-slideUp">
        <h2 class="text-3xl font-bold text-center text-blue-600">👜 Bolso artesanal exclusivo</h2>
        <img src="{{ asset('images/122/bolso3.webp') }}" alt="Bolso artesanal exclusivo" class="w-64 mx-auto rounded-lg mt-4">
        <p class="text-lg mt-4">Este bolso está hecho a mano con materiales de primera calidad, ideal para un look único y elegante.</p>
        <p class="text-red-500 font-bold text-xl mt-2">$45.000</p>

        <form action="{{ route('carrito.agregar') }}" method="POST" class="mt-4">
            @csrf
            <input type="hidden" name="name" value="Bolso artesanal exclusivo">
            <input type="hidden" name="price" value="45000">
            <input type="hidden" name="image_url" value="{{ asset('images/122/bolso3.webp') }}">
            <button type="submit"
                    class="w-full bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-transform transform hover:scale-105 hover:shadow-xl">
                Agregar al Carrito
            </button>
        </form>
    </main>

    <!-- Recomendaciones -->
    <section class="max-w-3xl w-full bg-white p-6 rounded-2xl shadow-lg text-gray-800 mt-10 animate-fadeIn">
        <h2 class="text-2xl font-bold text-center text-blue-600 mb-4">👜 También te puede gustar</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
            @php
                $otros = [
                    ['img' => 'bolso.jpg', 'nombre' => 'Bolso Casual', 'precio' => 35000],
                    ['img' => 'bolso2.webp', 'nombre' => 'Bolso de Cuero', 'precio' => 50000],
                    ['img' => 'bolso4.webp', 'nombre' => 'Bolso Moderno', 'precio' => 38000],
                ];
            @endphp

            @foreach($otros as $item)
                <div class="bg-gray-100 p-4 text-center rounded-xl shadow-md hover:shadow-xl hover:scale-105 transition-transform">
                    <img src="{{ asset('images/122/' . $item['img']) }}" alt="{{ $item['nombre'] }}" class="mx-auto rounded-md h-40 object-cover">
                    <p class="mt-2 font-bold">{{ $item['nombre'] }}</p>
                    <p class="text-red-500 font-bold text-lg">${{ number_format($item['precio'], 0, ',', '.') }}</p>
                    <form action="{{ route('carrito.agregar') }}" method="POST">
                        @csrf
                        <input type="hidden" name="name" value="{{ $item['nombre'] }}">
                        <input type="hidden" name="price" value="{{ $item['precio'] }}">
                        <input type="hidden" name="image_url" value="{{ asset('images/122/' . $item['img']) }}">
                        <button type="submit"
                                class="bg-green-500 text-white px-3 py-1 rounded-lg mt-2 hover:bg-green-600 hover:scale-105 transition-all duration-200">
                            Agregar al Carrito
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </section>

</body>
</html>
