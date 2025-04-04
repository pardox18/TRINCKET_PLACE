<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Carrito de Compras</title>
<style>
    body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
    .container { max-width: 800px; margin: 50px auto; padding: 20px; background: #ffffff; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); }
    h1 { font-size: 2rem; color: #333; }
    .producto { display: flex; justify-content: space-between; padding: 15px 0; border-bottom: 1px solid #ddd; }
    .producto img { width: 100px; border-radius: 8px; }
    .producto-info { flex: 1; padding-left: 20px; }
    .acciones { display: flex; gap: 10px; }
    .btn { padding: 10px 20px; background-color: #0073e6; color: white; text-decoration: none; border-radius: 5px; transition: background-color 0.3s; }
    .btn:hover { background-color: #005bb5; }
</style>
</head>
<body>
<div class="container">
    <h1>Carrito de Compras</h1>
    @foreach($items as $item)
    <div class="producto">
        <img src="{{ $item->producto->imagen }}" alt="{{ $item->producto->nombre }}">
        <div class="producto-info">
            <h2>{{ $item->producto->nombre }}</h2>
            <p>{{ $item->producto->descripcion }}</p>
            <p>Precio: ${{ $item->producto->precio }}</p>
            <p>Cantidad: {{ $item->cantidad }}</p>
        </div>
        <div class="acciones">
            <form action="{{ route('carrito.eliminar', $item->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn">Eliminar</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
</body>
</html>
