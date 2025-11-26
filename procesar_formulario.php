<?php
// Configuración de la conexión a la base de datos
$servidor = "localhost";
$usuario = "root";
$password = "";
$nombre_bd = "formulariov";

// Crear la conexión
$conn = new mysqli($servidor, $usuario, $password, $nombre_bd);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Procesar los datos del formulario cuando se envía (método POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanitizar datos del formulario
    $nombre = $conn->real_escape_string(htmlspecialchars($_POST['nombre']));
    $correo = $conn->real_escape_string(htmlspecialchars($_POST['correo']));
    $telefono = $conn->real_escape_string(htmlspecialchars($_POST['telefono']));
    $direccion = $conn->real_escape_string(htmlspecialchars($_POST['direccion']));
    $ciudad = $conn->real_escape_string(htmlspecialchars($_POST['ciudad']));
    $codigo_postal = $conn->real_escape_string(htmlspecialchars($_POST['codigo_postal']));
    $metodo_pago = $conn->real_escape_string(htmlspecialchars($_POST['metodo_pago']));
    $comentarios = isset($_POST['comentarios']) ? $conn->real_escape_string(htmlspecialchars($_POST['comentarios'])) : NULL;

    // Preparar la consulta SQL para insertar datos
    $sql = "INSERT INTO clientes (
        nombre,
        correo,
        telefono,
        direccion,
        ciudad,
        codigo_postal,
        metodo_pago,
        comentarios
    ) VALUES (
        '$nombre',
        '$correo',
        '$telefono',
        '$direccion',
        '$ciudad',
        '$codigo_postal',
        '$metodo_pago',
        " . ($comentarios ? "'$comentarios'" : "NULL") . "
    )";

    // Ejecutar la consulta y verificar si fue exitosa
    if ($conn->query($sql) === TRUE) {
        // Redirigir a una página de éxito
        header("Location: gracias.php");
        exit();
    } else {
        echo "<h1>¡Oops! Ha ocurrido un error al enviar tu formulario.</h1>";
        echo "<p>Por favor, intenta de nuevo más tarde.</p>";
        echo "<p><strong>Detalle del error:</strong> " . $conn->error . "</p>";
    }
} else {
    echo "<h1>Acceso no permitido.</h1>";
    echo "<p>Por favor, envía el formulario para procesar tus datos.</p>";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>