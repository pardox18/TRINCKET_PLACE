<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bienvenido a Trincket Place</title>
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
position: relative;
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
display: flex;
justify-content: center;
gap: 20px;
margin-top: 2rem;
}

.auth-buttons a {
background-color: #0073e6;
color: white;
padding: 12px 24px;
border-radius: 8px;
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
margin: 3rem auto;
overflow: hidden;
border-radius: 8px;
}

.carousel-inner {
display: flex;
transition: transform 0.5s ease-in-out;
}

.carousel-item {
min-width: 100%;
}

.carousel-item img {
width: 100%;
height: auto;
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
}

.carousel-button.left {
left: 10px;
}

.carousel-button.right {
right: 10px;
}

footer {
background-color: #0073e6;
color: white;
padding: 2rem 0;
margin-top: 3rem;
}

footer a {
color: white;
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
<header class="header">
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
<div class="mt-32 flex justify-center">
<form action="#" method="GET" class="flex items-center bg-white rounded-lg shadow-md w-1/2 sm:w-1/3 md:w-1/4">
<input type="text" name="search" placeholder="Buscar productos..." class="w-full py-2 px-4 rounded-l-lg">
<button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-r-lg">Buscar</button>
</form>
</div>

<!-- Botones de autenticación -->
<div class="auth-buttons mt-6">
<a href="{{ route('login') }}">Iniciar sesión</a>
<a href="{{ route('register') }}">Registrarse</a>
</div>

<!-- Carrusel de imágenes -->
<div class="carousel-container">
<div class="carousel-inner">
<div class="carousel-item">
<img src="https://www.pexels.com/photo/black-android-smartphone-on-brown-wooden-table-1092644/" alt="Celular">
</div>
<div class="carousel-item">
<img src="https://www.pexels.com/photo/assorted-clothes-hanged-on-clothes-rack-996329/" alt="Ropa">
</div>
<div class="carousel-item">
<img src="https://www.pexels.com/photo/white-front-load-washing-machine-1597911/" alt="Electrodoméstico">
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