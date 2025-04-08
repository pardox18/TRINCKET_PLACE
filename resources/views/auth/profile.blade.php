<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - Trincket Place</title>
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
<body class="bg-blue-100 text-gray-800 flex flex-col items-center min-h-screen">

    <!-- Encabezado -->
    <div class="w-full bg-white shadow-md py-4 px-6 flex justify-between items-center animate-slideUp">
        <h1 class="text-3xl font-bold text-blue-600">Trincket Place</h1>
        <div class="flex items-center gap-4">
            <form action="#" method="GET" class="relative">
                <input type="text" name="search" placeholder="Buscar productos..."
                    class="w-64 px-4 py-2 bg-blue-50 text-blue-900 border border-blue-300 rounded-full focus:ring-2 focus:ring-blue-400 placeholder-blue-500">
                <button type="submit" class="absolute right-3 top-2 text-blue-500 hover:text-blue-700">
                    🔍
                </button>
            </form>
            <a href="{{ route('home') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 hover:scale-105 transition-transform">Inicio</a>
        </div>
    </div>

    <!-- Perfil del Usuario -->
    <div class="w-full max-w-4xl mt-10 px-6 animate-fadeIn">
        <div class="bg-white p-6 rounded-2xl shadow-lg flex flex-col items-center">
            <div class="w-32 h-32 bg-blue-300 rounded-full overflow-hidden mb-4 border-4 border-white shadow-md">
                @if(Auth::user()->profile_photo)
                    <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Foto de perfil" class="w-full h-full object-cover">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=3b82f6&color=fff&size=128" alt="Avatar" class="w-full h-full object-cover">
                @endif
            </div>
            <h2 class="text-4xl font-extrabold text-blue-700 mb-1 text-center">{{ Auth::user()->name }}</h2>
            <p class="text-gray-600 mb-4 text-lg">¡Bienvenido a tu perfil personal!</p>
        </div>
    </div>

    <!-- Sección de Publicaciones -->
    <div class="max-w-7xl w-full px-6 mt-10">
        <div class="bg-white p-6 rounded-2xl shadow-lg text-gray-800 animate-fadeIn">
            <h3 class="text-2xl font-bold text-blue-600 mb-4">🛍️ Mis Publicaciones</h3>

            <button onclick="toggleModal()" class="mb-6 w-full bg-blue-600 text-white py-3 rounded-lg shadow-md hover:bg-blue-700 transition-transform transform hover:scale-105">
                ➕ Añadir Publicación
            </button>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if($products->isEmpty())
                <p class="text-gray-600">No has publicado ningún producto aún.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($products as $product)
                        <div class="bg-gray-100 p-4 rounded-xl shadow-md hover:shadow-xl transition-transform hover:scale-105">
                            <img src="{{ asset('storage/' . $product->imagen) }}" alt="{{ $product->nombre }}" class="w-full h-40 object-cover rounded mb-3">
                            <h5 class="text-lg font-bold text-gray-800">{{ $product->nombre }}</h5>
                            <!-- ✅ Mostrar categoría -->
                            @if($product->category)
                                <p class="text-sm text-purple-600 mb-1">Categoría: <span class="font-semibold">{{ $product->category->nombre }}</span></p>
                            @endif
                            <p class="text-sm text-gray-600 mb-2">{{ $product->descripcion }}</p>
                            <p class="text-red-500 font-bold text-lg">$ {{ number_format($product->precio, 0, ',', '.') }}</p>
                            <p class="text-sm text-blue-600 mt-1">Cantidad disponible: <span class="font-semibold">{{ $product->cantidad }}</span></p>
                            <div class="mt-4 flex justify-between">
                                <a href="{{ route('products.edit', $product->id) }}" class="px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Editar</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-2 bg-red-600 text-white rounded hover:bg-red-700">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Publicación -->
    <div id="modalPublicacion" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white w-full max-w-md p-6 rounded-xl shadow-lg animate-fadeIn text-gray-800">
            <h2 class="text-xl font-bold mb-4 text-blue-600">Crear nueva publicación</h2>
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="text" name="nombre" placeholder="Nombre del producto" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                <textarea name="descripcion" rows="3" placeholder="Descripción" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required></textarea>
                <input type="number" name="precio" step="0.01" placeholder="Precio" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                <input type="number" name="cantidad" min="1" placeholder="Cantidad disponible" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                <!-- ✅ Campo de categoría -->
                <input type="text" name="categoria" placeholder="Categoría" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-purple-400" required>
                <input type="file" name="imagen" class="w-full text-sm" required>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="toggleModal()" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Cancelar</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Publicar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal() {
            const modal = document.getElementById('modalPublicacion');
            modal.classList.toggle('hidden');
        }
    </script>

</body>
</html>
