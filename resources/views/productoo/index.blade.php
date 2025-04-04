<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Productos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .product-list {
            padding: 20px;
        }
        .product-card {
            background-color: #ffffff;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            box-shadow: 0px 0px 5px #ccc;
        }
        .product-card h2 {
            margin: 0;
        }
    </style>
</head>
<body>
    <h1>Lista de Productos</h1>
    <div class="product-list">
        @forelse($productos as $producto)
        <div class="product-card">
            <h2>{{ $producto->nombre }}</h2>
            <p>{{ $producto->descripcion }}</p>
            <p>Precio: ${{ $producto->precio }}</p>
            <form action="{{ route('productoo.agregarAlCarrito', $producto->id) }}" method="GET">
                <button type="submit">Agregar al Carrito</button>
            </form>
        </div>
        @empty
        <p>No hay productos disponibles.</p>
        @endforelse
    </div>
</body>
</html>
