<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Trincket Place</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7fafc;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #0073e6;
            padding: 1rem 2rem;
        }
        .header .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
        }
        .header nav a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-size: 1rem;
        }
        .header nav a:hover {
            text-decoration: underline;
        }
        .search-bar {
            margin: 2rem auto;
            width: 80%;
            max-width: 500px;
            display: flex;
            align-items: center;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .search-bar input {
            flex: 1;
            padding: 0.75rem 1rem;
            border: none;
            outline: none;
            border-radius: 8px 0 0 8px;
        }
        .search-bar button {
            background-color: #0073e6;
            color: white;
            padding: 0.75rem 1rem;
            border-radius: 0 8px 8px 0;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header shadow-md fixed w-full z-10 top-0 left-0">
        <div class="flex justify-between items-center">
            <div class="logo">Trincket Place</div>
            <nav>
                <a href="#">Inicio</a>
                <a href="#">Categorías</a>
                <a href="#">Ofertas</a>
                <a href="#">Mi Cuenta</a>
            </nav>
        </div>
    </header>
    <!-- Barra de búsqueda -->
    <div class="auth-buttons mt-24">
        <div class="search-bar">
            <input type="text" placeholder="Buscar productos..." />
            <button>🔍</button>
        </div>
        <a href="{{ route('login') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg">Iniciar sesión</a>
        <a href="{{ route('register') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg">Registrarse</a>
    </div>
</body>
</html>
