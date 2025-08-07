<?php
// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'galeria');
define('DB_CHARSET', 'utf8mb4');

// Establecer conexión
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Verificar conexión
if ($conn->connect_error) {
    error_log("Error de conexión: " . $conn->connect_error);
    die("Lo sentimos, estamos experimentando problemas técnicos. Por favor intenta más tarde.");
}

// Configurar charset
$conn->set_charset(DB_CHARSET);

// Función para limpiar datos
function limpiarDatos($conn, $data) {
    return htmlspecialchars($conn->real_escape_string(trim($data)));
}
?>