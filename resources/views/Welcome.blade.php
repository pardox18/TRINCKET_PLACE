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

        .auth-buttons {
            position: absolute;
            top: 20%;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 20px;
            z-index: 20;
        }

        .auth-buttons a {
            background-color: #0073e6;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            text-align: center;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .auth-buttons a:hover {
            background-color: #005bb5;
        }

        .carousel-container {
            position: relative;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            overflow: hidden;
            border-radius: 8px;
        }

        .carousel-inner {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .carousel-item {
            min-width: 100%;
            transition: transform 0.5s ease-in-out;
        }

        .carousel-item img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .carousel-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            font-size: 2rem;
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
            z-index: 10;
        }

        .carousel-button.left {
            left: 10px;
        }

        .carousel-button.right {
            right: 10px;
        }

        footer {
            background-color: #333;
            color: white;
            padding: 2rem 0;
        }

        footer a {
            color: #0073e6;
            text-decoration: none;
            margin-left: 10px;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .footer-content {
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header class="header shadow-md fixed w-full z-10 top-0 left-0">
        <div class="flex justify-between items-center">
            <div class="logo">
                Trincket Place
            </div>
            <nav>
                <a href="#">Inicio</a>
                <a href="#">Categorías</a>
                <a href="#">Ofertas</a>
                <a href="#">Mi Cuenta</a>
            </nav>
        </div>
    </header>

    <!-- Botones de Iniciar sesión y Registrarse debajo del título -->
    <div class="auth-buttons">
        <a href="{{ route('login') }}">Iniciar sesión</a>
        <a href="{{ route('register') }}">Registrarse</a>
    </div>

    <!-- Carrusel de imágenes -->
    <div class="carousel-container mt-24">
        <div class="carousel-inner">
            <div class="carousel-item">
                <img src="https://via.placeholder.com/1200x400/0073e6/ffffff?text=Imagen+1" alt="Imagen 1">
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/1200x400/0073e6/ffffff?text=Imagen+2" alt="Imagen 2">
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/1200x400/0073e6/ffffff?text=Imagen+3" alt="Imagen 3">
            </div>
        </div>
        <button class="carousel-button left">&#10094;</button>
        <button class="carousel-button right">&#10095;</button>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <p>&copy; 2025 Trincket Place - Todos los derechos reservados.</p>
            <div>
                <a href="#">Facebook</a>
                <a href="#">Instagram</a>
                <a href="#">Twitter</a>
            </div>
        </div>
    </footer>

    <script>
        const leftButton = document.querySelector('.carousel-button.left');
        const rightButton = document.querySelector('.carousel-button.right');
        const carouselInner = document.querySelector('.carousel-inner');
        let index = 0;

        leftButton.addEventListener('click', () => {
            index = (index === 0) ? 2 : index - 1;
            carouselInner.style.transform = `translateX(-${index * 100}%)`;
        });

        rightButton.addEventListener('click', () => {
            index = (index === 2) ? 0 : index + 1;
            carouselInner.style.transform = `translateX(-${index * 100}%)`;
        });
    </script>
</body>
</html>
