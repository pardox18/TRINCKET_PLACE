<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        fadeIn: "fadeIn 0.5s ease-in-out",
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
<body class="bg-gray-100 flex items-center justify-center min-h-screen text-gray-800">
    <div class="max-w-4xl w-full bg-white p-6 rounded-2xl shadow-lg animate-slideUp">
        <h2 class="text-3xl font-bold text-center text-blue-700 mb-6">Mi Perfil</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Información Personal -->
            <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-700">Información Personal</h3>
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="mt-4 space-y-4">
                    @csrf
                    <div>
                        <label class="font-bold text-gray-700">Foto de Perfil</label>
                        <input type="file" name="profile_picture" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-400">
                    </div>
                    <div>
                        <label class="font-bold text-gray-700">Descripción</label>
                        <textarea name="bio" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-400" placeholder="Escribe algo sobre ti..."></textarea>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg shadow-md hover:bg-blue-700 transition-transform transform hover:scale-105">Guardar Cambios</button>
                </form>
            </div>

            <!-- Publicaciones -->
            <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-700">Mis Publicaciones</h3>
                <button onclick="toggleModal()" class="mt-3 w-full bg-blue-600 text-white py-3 rounded-lg shadow-md hover:bg-blue-700 transition-transform transform hover:scale-105">Añadir Publicación</button>
                <div class="grid grid-cols-1 gap-4 mt-4">
                    <div class="bg-white p-4 shadow rounded border">
                        <img src="/images/producto1.jpg" class="w-full h-40 object-cover rounded">
                        <h5 class="mt-2 font-bold text-gray-800">Producto Ejemplo</h5>
                        <p class="text-blue-600 font-bold">$40.000</p>
                        <div class="mt-3 flex justify-between">
                            <button class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Editar</button>
                            <button class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Publicación -->
    <div id="modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96 animate-slideUp">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Añadir Publicación</h3>
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                @csrf
                <label class="block text-gray-700 font-semibold">Selecciona una imagen</label>
                <input type="file" name="image" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-400" required>

                <label class="block text-gray-700 font-semibold">Nombre del Producto</label>
                <input type="text" name="name" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-400" required>

                <label class="block text-gray-700 font-semibold">Descripción</label>
                <textarea name="description" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-400" required></textarea>

                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="toggleModal()" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Función para abrir y cerrar el modal
        function toggleModal() {
            document.getElementById('modal').classList.toggle('hidden');
        }
    </script>
</body>
</html>
