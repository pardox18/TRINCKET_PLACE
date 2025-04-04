<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Métodos de Pago</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8;
            text-align: center;
            padding: 50px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 { color: #333; }
        .payment-options {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 20px;
        }
        .btn {
            display: block;
            padding: 12px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            width: 100%;
            background-color: #007bff;
            color: white;
        }
        .btn:hover { opacity: 0.8; }
        .back-btn {
            margin-top: 20px;
            display: inline-block;
            padding: 10px 20px;
            background-color: #0056b3;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-btn:hover { background-color: #004494; }

        .payment-form {
            display: none;
            margin-top: 20px;
            text-align: left;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn-submit {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }
        .btn-submit:hover {
            background-color: #218838;
        }
    </style>
    <script>
        function mostrarFormulario(metodo) {
            document.getElementById('payment-form').style.display = 'block';
            document.getElementById('payment-method').value = metodo;
        }

        function validarFormulario(event) {
            const nombre = document.getElementById('nombre').value.trim();
            const email = document.getElementById('email').value.trim();
            const direccion = document.getElementById('direccion').value.trim();
            const telefono = document.getElementById('telefono').value.trim();
            const metodo = document.getElementById('payment-method').value;

            if (!nombre || !email || !direccion || !telefono || !metodo) {
                alert('Por favor, complete todos los campos requeridos.');
                event.preventDefault();
                return false;
            }

            if (!/^[0-9]{10}$/.test(telefono)) {
                alert('El teléfono debe tener exactamente 10 dígitos.');
                event.preventDefault();
                return false;
            }

            if (!confirm('¿Está seguro de que desea confirmar el pago?')) {
                event.preventDefault();
                return false;
            }
        }
    </script>
</head>
<body>

    <div class="container">
        <h1>Selecciona un Método de Pago</h1>
        <div class="payment-options">
            <button class="btn" onclick="mostrarFormulario('Tarjeta')">💳 Tarjeta de Crédito / Débito</button>
            <button class="btn" onclick="mostrarFormulario('PayPal')">🅿️ PayPal</button>
            <button class="btn" onclick="mostrarFormulario('Transferencia')">🏦 Transferencia Bancaria</button>
        </div>

        <!-- Mostrar errores de validación -->
        @if ($errors->any())
            <div style="color: red; margin-bottom: 15px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario de pago -->
        <div id="payment-form" class="payment-form">
            <h2>Detalles del Pago</h2>
            <form action="{{ route('pago.procesar') }}" method="POST" onsubmit="validarFormulario(event)">
                @csrf
                <input type="hidden" id="payment-method" name="metodo_pago">

                <div class="form-group">
                    <label for="nombre">Nombre en la Tarjeta / Cuenta:</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>

                <div class="form-group">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="direccion">Dirección de Envío:</label>
                    <input type="text" id="direccion" name="direccion" required>
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono de Contacto:</label>
                    <input type="text" id="telefono" name="telefono" pattern="[0-9]{10}" title="Ingrese un número de 10 dígitos" required>
                </div>

                <div class="form-group">
                    <label for="monto">Monto a Pagar:</label>
                    <input type="text" id="monto" name="monto" value="{{ $total ?? '' }}" readonly>
                </div>

                <button type="submit" class="btn-submit">Confirmar Pago</button>
            </form>
        </div>

        <a href="{{ route('carrito.index') }}" class="back-btn">Volver al Carrito</a>
    </div>

</body>
</html>
