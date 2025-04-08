<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #ebf8ff; /* Este es el color bg-blue-100 */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            width: 90%;
            max-width: 1000px;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        td img {
            width: 60px;
            border-radius: 8px;
        }
        input[type="number"] {
            width: 60px;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .total {
            text-align: right;
            font-size: 1.2em;
            font-weight: bold;
            margin-top: 10px;
        }
        .actions {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            flex-wrap: wrap;
            gap: 10px;
        }
        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
            text-decoration: none;
            text-align: center;
        }
        .btn-primary {
            background-color: #28a745;
            color: white;
        }
        .btn-primary:hover {
            background-color: #218838;
        }
        .btn-secondary {
            background-color: #007bff;
            color: white;
        }
        .btn-secondary:hover {
            background-color: #0056b3;
        }
        .update-btn {
            background-color: #ffc107;
            color: #000;
        }
        .update-btn:hover {
            background-color: #e0a800;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>🛒 Tu Carrito de Compras</h1>

    @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 10px 15px; border-radius: 5px; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    @php $productosVisibles = 0; @endphp

    @foreach($carrito as $producto)
        @if(!empty($producto['nombre']) && $producto['precio'] > 0 && $producto['cantidad'] > 0)
            @php $productosVisibles++; @endphp
        @endif
    @endforeach

    @if($productosVisibles > 0)
        <form action="{{ route('carrito.actualizar') }}" method="POST">
            @csrf
            <table>
                <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                    <th>Acción</th>
                </tr>
                </thead>
                <tbody>
                @foreach($carrito as $id => $producto)
                    @if(!empty($producto['nombre']) && $producto['precio'] > 0 && $producto['cantidad'] > 0)
                        <tr>
                            <td><img src="{{ $producto['imagen'] }}" alt="{{ $producto['nombre'] }}"></td>
                            <td>{{ $producto['nombre'] }}</td>
                            <td>
                                <input type="number" name="cantidades[{{ $id }}]" value="{{ $producto['cantidad'] }}" min="1">
                            </td>
                            <td>${{ number_format($producto['precio'], 0, ',', '.') }}</td>
                            <td>${{ number_format($producto['precio'] * $producto['cantidad'], 0, ',', '.') }}</td>
                            <td>
                            <form action="{{ route('carrito.eliminar', $id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este producto del carrito?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>


                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>

            <div class="total">Total: ${{ number_format($total, 0, ',', '.') }}</div>

            <div class="actions">
                <a href="{{ route('index') }}" class="btn btn-secondary">Seguir comprando</a>
                <button type="submit" class="btn update-btn">Actualizar Cantidades</button>
                <a href="{{ route('metodos.pago') }}" class="btn btn-primary">Proceder al Pago</a>
            </div>
        </form>
    @else
        <p style="text-align: center; font-size: 18px;">Tu carrito está vacío 🛍️</p>
        <div class="actions" style="justify-content: center;">
            <a href="{{ route('product.index') }}" class="btn btn-secondary">Explorar productos</a>
        </div>
    @endif
</div>
</body>
</html>
