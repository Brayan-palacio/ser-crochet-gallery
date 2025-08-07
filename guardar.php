<?php
include("db.php");

// Configuración
$maxFileSize = 5 * 1024 * 1024; // 5MB
$allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
$carpetaDestino = "uploads/";

// Crear carpeta si no existe
if (!file_exists($carpetaDestino)) {
    mkdir($carpetaDestino, 0755, true);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["imagen"])) {
    // Limpiar y validar datos
    $nombre = limpiarDatos($conn, $_POST["nombre"]);
    $categoria = limpiarDatos($conn, $_POST["categoria"]);
    $archivo = $_FILES["imagen"];

    // Validar archivo
    if ($archivo["error"] !== UPLOAD_ERR_OK) {
        die("Error al subir el archivo: " . getUploadError($archivo["error"]));
    }

    // Validar tipo y tamaño
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($archivo["tmp_name"]);

    if (!in_array($mime, $allowedTypes)) {
        die("Tipo de archivo no permitido. Solo se aceptan JPG, PNG, GIF o WEBP.");
    }

    if ($archivo["size"] > $maxFileSize) {
        die("El archivo es demasiado grande (máximo 5MB)");
    }

    // Generar nombre único seguro
    $extension = pathinfo($archivo["name"], PATHINFO_EXTENSION);
    $nombreOriginal = $archivo["name"];
    $nombreArchivo = uniqid() . '_' . bin2hex(random_bytes(8)) . '.' . $extension;
    
    // Verificar si el archivo ya existe (por si acaso)
    while (file_exists($carpetaDestino . $nombreArchivo)) {
        $nombreArchivo = uniqid() . '_' . bin2hex(random_bytes(8)) . '.' . $extension;
    }
    
    $rutaFinal = $carpetaDestino . $nombreArchivo;

    // Mover archivo
    if (move_uploaded_file($archivo["tmp_name"], $rutaFinal)) {
        // URL completa
        $urlCompleta = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . 
                      $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/' . $rutaFinal;

        // Usar sentencias preparadas para evitar SQL injection
        $stmt = $conn->prepare("INSERT INTO imagenes (nombre, nombre_original, nombre_archivo, url, categoria, tipo, tamaño) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssi", $nombre, $nombreOriginal, $nombreArchivo, $urlCompleta, $categoria, $mime, $archivo["size"]);

        if ($stmt->execute()) {
            header("Location: galeria.php?success=1");
            exit();
        } else {
            // Eliminar archivo si falla la DB
            unlink($rutaFinal);
            die("Error al guardar en la base de datos: " . $stmt->error);
        }
    } else {
        die("Error al mover el archivo subido.");
    }
} else {
    die("Método no permitido o archivo no enviado.");
}

function getUploadError($code) {
    $errors = [
        UPLOAD_ERR_INI_SIZE => 'El archivo excede el tamaño máximo permitido',
        UPLOAD_ERR_FORM_SIZE => 'El archivo excede el tamaño máximo del formulario',
        UPLOAD_ERR_PARTIAL => 'El archivo solo se subió parcialmente',
        UPLOAD_ERR_NO_FILE => 'No se seleccionó ningún archivo',
        UPLOAD_ERR_NO_TMP_DIR => 'Falta la carpeta temporal',
        UPLOAD_ERR_CANT_WRITE => 'No se pudo escribir el archivo en el disco',
        UPLOAD_ERR_EXTENSION => 'Una extensión de PHP detuvo la subida'
    ];
    
    return $errors[$code] ?? 'Error desconocido';
}
?>