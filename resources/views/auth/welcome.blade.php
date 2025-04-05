<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trincket Place - Bienvenido</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f2f6fc;
            color: #003366;
            line-height: 1.6;
        }

        .header {
            background-color: #eaf3ff;
            padding: 50px;
            text-align: center;
        }

        .header h1 {
            color: #003366;
            font-size: 3.5rem;
            font-weight: bold;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.2);
        }

        .header p {
            color: #666;
            font-size: 1.2rem;
            margin: 10px 0 20px;
        }

        .buttons button {
            background-color: #0066cc;
            color: white;
            border: none;
            padding: 10px 20px;
            margin: 5px;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .buttons button:hover {
            background-color: #004c99;
        }

        .search-section {
            text-align: center;
            margin: 20px;
        }

        .search-section input {
            width: 60%;
            padding: 10px;
            border: 2px solid #0066cc;
            border-radius: 20px;
            outline: none;
            transition: box-shadow 0.3s ease;
        }

        .search-section input:focus {
            box-shadow: 0 0 10px rgba(0, 102, 204, 0.5);
        }

        .carousel-container {
            position: relative;
            margin: 20px auto;
            width: 80%;
            max-width: 800px;
            overflow: hidden;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .carousel-inner {
            display: flex;
            transition: transform 1s ease-in-out;
        }

        .carousel-item {
            min-width: 100%;
            text-align: center;
        }

        .carousel-item img {
            width: 100%;
            max-height: 200px;
            object-fit: contain;
            border-radius: 10px;
        }

        .categories {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
            margin: 30px auto;
            padding: 20px;
            background: #eaf3ff;
            border-radius: 10px;
        }

        .category-card {
            background-color: #0066cc;
            color: white;
            padding: 15px 25px;
            border-radius: 15px;
            text-align: center;
            font-weight: bold;
            font-size: 1.1rem;
            transition: transform 0.3s ease, background-color 0.3s ease;
            cursor: pointer;
        }

        .category-card:hover {
            transform: scale(1.1);
            background-color: #004c99;
        }
    </style>
</head>
<body>
    <header class="header">
        <h1>Bienvenido a Trincket Place</h1>
        <p>Compra, Vende y Descubre. Todo en un Solo Lugar.</p>
        <div class="buttons">
            <button onclick="location.href='{{ route('login') }}'">Iniciar sesión</button>
            <button onclick="location.href='{{ route('register') }}'">Registrarse</button>
        </div>
    </header>
    <section class="search-section">
        <form action="{{ route('products.index') }}" method="GET">
            <input type="text" name="search" placeholder="Buscar productos...">
        </form>
    </section>
    <div class="carousel-container">
        <div class="carousel-inner" id="carousel">
            <div class="carousel-item">
                <img src="{{ asset('images/productos/imagen1.webp') }}" alt="Producto 1">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/productos/imagen2.jpg') }}" alt="Producto 2">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/productos/imagen3.jpg') }}" alt="Producto 3">
            </div>
        </div>
    </div>
    <script>
        let currentIndex = 0;
        const slides = document.querySelectorAll('.carousel-item');
        const totalSlides = slides.length;

        function showSlide() {
            document.getElementById('carousel').style.transform = `translateX(${-currentIndex * 100}%)`;
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % totalSlides;
            showSlide();
        }

        setInterval(nextSlide, 3000);
    </script>
    <section class="categories">
        <div class="category-card">Electrónica</div>
        <div class="category-card">Ropa</div>
        <div class="category-card">Hogar</div>
        <div class="category-card">Videojuegos</div>
        <div class="category-card">Libros</div>
        <div class="category-card">Herramientas</div>
    </section>
    <footer style="background-color: #0066cc; color: white; text-align: center; padding: 20px; margin-top: 20px;">
        <p style="margin-bottom: 10px;">© 2025 Trincket Place - Todos los derechos reservados.</p>
        <div class="social-links">
            <a href="#" style="color: white; margin: 0 10px; text-decoration: none;">Facebook</a>
            <a href="#" style="color: white; margin: 0 10px; text-decoration: none;">Instagram</a>
            <a href="#" style="color: white; margin: 0 10px; text-decoration: none;">Twitter</a>
        </div>
    </footer>
</body>
</html>
