<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trincket Place - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.10.5/cdn.min.js" defer></script>
</head>
<body class="bg-blue-100 text-gray-900" x-data="{ search: '' }">
    
    <!-- Barra de navegación -->
    <nav class="bg-white text-gray-900 p-4 flex justify-between items-center shadow-lg">
        <h1 class="text-3xl font-bold text-blue-600">Trincket Place</h1>
        
        <!-- Barra de búsqueda funcional -->
        <div class="relative w-1/3">
            <input type="text" x-model="search" placeholder="Buscar productos..." class="w-full p-2 rounded-lg bg-white text-black border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all">
        </div>
        
        <!-- Opciones de usuario -->
        <div class="flex items-center space-x-6">
            <a href="{{ route('home') }}" class="bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition-all">Inicio</a>
            <a href="{{ route('profile.show') }}" class="bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition-all">Mi Perfil</a>
            <a href="{{ route('carrito.index') }}" class="bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition-all">Carrito</a>
            <span class="font-bold text-blue-600">{{ auth()->user()->name ?? 'Invitado' }}</span>
            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-all">Cerrar Sesión</button>
                </form>
            @endauth
        </div>
    </nav>
    
    <!-- Carrusel de Ofertas Automático -->
    <div class="container mx-auto mt-6 p-4 bg-white shadow-lg rounded-lg w-3/4">
        <h2 class="text-2xl font-bold mb-4 text-blue-600">🔥 Ofertas Especiales</h2>
        <div x-data="{ 
            currentSlide: 0, 
            slides: [
                '{{ asset("images/oferta1.webp") }}', 
                '{{ asset("images/oferta2.avif") }}', 
                '{{ asset("images/oferta3.webp") }}'
            ], 
            autoSlide() { 
                setInterval(() => { 
                    this.currentSlide = (this.currentSlide + 1) % this.slides.length 
                }, 3000) 
            } 
        }" x-init="autoSlide()" class="relative w-full overflow-hidden">
            <template x-for="(slide, index) in slides" :key="index">
                <img :src="slide" class="w-1/3 mx-auto rounded-lg" x-show="currentSlide === index" x-transition:enter="transition ease-out duration-1000" x-transition:leave="transition ease-in duration-1000">
            </template>
        </div>
    </div>
    
    <!-- Más Vendidos -->
    <div class="container mx-auto mt-6 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-3xl font-bold mb-4 text-blue-600">🏆 Más Vendidos</h2>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6" 
            x-data="{ 
                products: [
                    { name: 'Bolso hecho a mano', price: '$40.000', image: '{{ asset('images/bolso.webp') }}', route: '{{ route('producto.bolso') }}' },
                    { name: 'Arequipe artesanal', price: '$10.000', image: '{{ asset('images/122/Arequipe.webp') }}', route: '{{ route('producto.arequipe') }}' },
                    { name: 'Llaveros hechos a mano', price: '$15.000', image: '{{ asset('images/llavero.webp') }}', route: '{{ route('producto.llavero') }}' },
                    { name: 'Pinturas retrato', price: '$50.000', image: '{{ asset('images/mona.jpg') }}', route: '{{ route('producto.pintura') }}' }
                ] 
            }">
            <template x-for="product in products.filter(p => p.name.toLowerCase().includes(search.toLowerCase()))" :key="product.name">
                <a :href="product.route" class="bg-gray-200 p-4 text-center rounded-lg shadow-md hover:scale-105 transform transition-all duration-200">
                    <img :src="product.image" class="mx-auto rounded-md w-full h-40 object-cover">
                    <p class="mt-2 font-bold" x-text="product.name"></p>
                    <p class="text-red-500 font-bold text-lg" x-text="product.price"></p>
                </a>
            </template>
        </div>
    </div>
    
    <!-- Categorías -->
    <div class="container mx-auto mt-6 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-3xl font-bold mb-4 text-blue-600">📂 Categorías</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @php
                $categorias = [
                    ['nombre' => 'accesorios', 'imagen' => 'images/accesorios.jpg'],
                    ['nombre' => 'moda', 'imagen' => 'images/moda.png'],
                    ['nombre' => 'a_mano', 'imagen' => 'images/mano.png'],
                    ['nombre' => 'artesano', 'imagen' => 'images/artesano.jpg'],
                ];
            @endphp

            @foreach ($categorias as $categoria)
                <a href="{{ route('categoria.show', ['categoria' => $categoria['nombre']]) }}" class="bg-blue-100 hover:bg-blue-200 transition-all duration-300 text-center p-4 rounded-xl shadow-md hover:scale-105 transform">
                    <img src="{{ asset($categoria['imagen']) }}" alt="{{ $categoria['nombre'] }}" class="w-24 h-24 object-cover mx-auto rounded-full mb-3 shadow">
                    <span class="text-lg font-semibold text-gray-700">
                        {{ ucfirst(str_replace('_', ' ', $categoria['nombre'])) }}
                    </span>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Beneficios -->
    <div class="container mx-auto mt-6 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-3xl font-bold mb-4 text-blue-600">🎯 ¿Por qué comprar en Trincket Place?</h2>
        <ul class="list-disc ml-6 text-lg">
            <li>🚚 Envíos rápidos y seguros</li>
            <li>🔒 Pagos 100% protegidos</li>
            <li>🔄 Devoluciones fáciles y sin problemas</li>
            <li>🌎 Compra en cualquier parte del mundo</li>
        </ul>
    </div>
    
</body>
</html>
