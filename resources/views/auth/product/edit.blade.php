<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto - Trincket Place</title>
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

<body class="bg-blue-500 text-white flex flex-col items-center min-h-screen">

    <!-- Encabezado -->
    <div class="w-full bg-white shadow-md py-4 px-6 flex justify-between items-center animate-slideUp">
        <h1 class="text-3xl font-bold text-blue-600">Trincket Place</h1>
        <div class="flex items-center gap-4">
            <p class="text-blue-700 font-semibold">👤 {{ Auth::user()->name ?? 'Invitado' }}</p>
            <a href="{{ route('home') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 hover:scale-105 transition-transform">Inicio</a>
        </div>
    </div>

    <!-- Formulario de Edición de Producto -->
    <div class="max-w-4xl w-full bg-white p-8 rounded-2xl shadow-lg text-gray-800 mt-10 animate-slideUp">
        <h2 class="text-4xl font-bold text-blue-600 mb-6 text-center">Editar Producto</h2>

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nombre del Producto -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nombre del Producto</label>
                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                    class="mt-1 block w-full px-4 py-2 border border-blue-300 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @error('name')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Descripción del Producto -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea name="description" id="description" rows="4"
                    class="mt-1 block w-full px-4 py-2 border border-blue-300 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Precio del Producto -->
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Precio</label>
                <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price) }}"
                    class="mt-1 block w-full px-4 py-2 border border-blue-300 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @error('price')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Cantidad del Producto -->
            <div class="mb-4">
                <label for="quantity" class="block text-sm font-medium text-gray-700">Cantidad</label>
                <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $product->quantity ?? '') }}"
                    class="mt-1 block w-full px-4 py-2 border border-blue-300 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('quantity')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Imagen del Producto -->
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Imagen del Producto</label>
                <input type="file" name="image" id="image"
                    class="mt-1 block w-full px-4 py-2 border border-blue-300 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('image')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Categoría del Producto -->
            <div class="mb-4">
                <label for="category" class="block text-sm font-medium text-gray-700">Categoría</label>
                <input type="text" name="category" id="category" value="{{ old('category', $product->category ?? '') }}"
                    class="mt-1 block w-full px-4 py-2 border border-blue-300 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('category')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Botón para Guardar -->
            <div>
                <button type="submit"
                    class="w-full py-3 bg-green-600 text-white text-lg rounded-lg shadow-xl hover:bg-green-700 hover:scale-105 transition-all ease-in-out">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>

</body>

</html>
