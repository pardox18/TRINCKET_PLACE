<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trincket Place - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.10.5/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100 text-gray-900" x-data="{ search: '' }">
    
    <!-- Barra de navegación -->
    <nav class="bg-blue-600 text-white p-4 flex justify-between items-center shadow-lg">
        <h1 class="text-3xl font-bold">Trincket Place</h1>
        
        <!-- Barra de búsqueda funcional -->
        <div class="relative w-1/3">
            <input type="text" x-model="search" placeholder="Buscar productos..." class="w-full p-2 rounded-lg text-black">
        </div>
        
        <!-- Opciones de usuario -->
        <div class="flex items-center space-x-6">
            <a href="{{ route('home') }}" class="hover:underline">Inicio</a>
            <a href="{{ route('profile.show') }}" class="hover:underline">Mi Perfil</a>
            <span class="font-bold">{{ auth()->user()->name ?? 'Invitado' }}</span>
            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 px-3 py-1 rounded-lg">Cerrar Sesión</button>
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
                '{{ asset("images/oferta1.jpg") }}', 
                '{{ asset("images/oferta2.jpg") }}', 
                '{{ asset("images/oferta3.jpg") }}'
            ], 
            autoSlide() { 
                setInterval(() => { 
                    this.currentSlide = (this.currentSlide + 1) % this.slides.length 
                }, 3000) 
            } 
        }" x-init="autoSlide()" class="relative w-full overflow-hidden">
            <template x-for="(slide, index) in slides" :key="index">
                <img :src="slide" class="w-1/3 mx-auto rounded-lg" x-show="currentSlide === index" x-transition>
            </template>
        </div>
    </div>
    
    <!-- Más Vendidos -->
    <div class="container mx-auto mt-6 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-3xl font-bold mb-4 text-blue-600">🏆 Más Vendidos</h2>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6" 
            x-data="{ 
                products: [
                    { name: 'Bolso hecho a mano', price: '$40.000', image: '{{ asset('images/producto1.jpg') }}', route: '{{ route('producto.bolso') }}' },
                    { name: 'Arequipe artesanal', price: '$10.000', image: '{{ asset('images/producto2.jpg') }}', route: '{{ route('producto.arequipe') }}' },
                    { name: 'Llaveros hechos a mano', price: '$15.000', image: '{{ asset('images/producto3.jpg') }}', route: '{{ route('producto.llavero') }}' },
                    { name: 'Pinturas retrato', price: '$50.000', image: '{{ asset('images/producto4.jpg') }}', route: '{{ route('producto.pintura') }}' }
                ] 
            }">
            <template x-for="product in products.filter(p => p.name.toLowerCase().includes(search.toLowerCase()))" :key="product.name">
                <a :href="product.route" class="bg-gray-200 p-4 text-center rounded-lg shadow-md hover:scale-105 transform transition">
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
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach (['accesorios', 'moda', 'a_mano', 'artesano'] as $categoria)
                <a href="{{ url('/categoria/' . $categoria) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg flex flex-col items-center shadow-md">
                    <img src="{{ asset('images/categoria' . ($loop->index + 1) . '.jpg') }}" class="w-20 h-20 rounded-full">
                    {{ ucfirst(str_replace('_', ' ', $categoria)) }}
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
