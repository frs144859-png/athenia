<?php
session_start();
$cart = isset($_SESSION['cart']) ? json_decode($_SESSION['cart'], true) : [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gracias por tu compra - Athenia</title>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #FAF9F6;
            color: #333;
            text-align: center;
            padding: 50px 20px;
        }
        .success-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .emoji {
            font-size: 60px;
            margin-bottom: 20px;
            color: #ff9bb3;
        }
        h1 {
            color: #ff9bb3;
            margin-bottom: 20px;
        }
        .order-summary {
            margin: 30px 0;
            text-align: left;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
        .order-details {
            margin-top: 30px;
        }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background: #ff9bb3;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn:hover {
            background: #ff7a9e;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="emoji">✓</div>
        <h1>¡Gracias por tu compra!</h1>
        <p>Hemos recibido tu pedido correctamente. Te enviaremos un correo de confirmación con los detalles.</p>
        
        <div class="order-summary">
            <h3>Resumen de tu pedido:</h3>
            <ul>
                <?php 
                $total = 0;
                foreach ($cart as $item) {
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                    echo "<li>{$item['quantity']} x {$item['name']} - $".number_format($subtotal, 2)." MXN</li>";
                }
                ?>
            </ul>
            <p><strong>Total: $<?php echo number_format($total, 2); ?> MXN</strong></p>
        </div>
        
        <div class="order-details">
            <p>Número de referencia: #<?php echo substr(uniqid(), -8); ?></p>
            <p>Te contactaremos pronto para confirmar los detalles de envío.</p>
        </div>
        
        <a href="index.html" class="btn">Volver al inicio</a>
    </div>
</body>
</html>
<?php
unset($_SESSION['cart']); // Limpiar el carrito después de mostrar
?>