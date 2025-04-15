<?php
// Mostrar errores para depurar
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre   = $_POST["nombre"] ?? '';
    $apellido = $_POST["apellido"] ?? '';
    $email    = $_POST["email"] ?? '';
    $telefono = $_POST["telefono"] ?? '';
    $mensaje  = $_POST["mensaje"] ?? '';

    // Datos de destino
    $destinatario = "soporte@grupointegral.net";
    $asunto       = "Página Grupo Integral: Nuevo mensaje de contacto";

    // Encabezados más seguros
    $headers  = "From: Grupo Integral <no-reply@grupointegral.net>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Cuerpo del mensaje
    $cuerpoMensaje  = "<strong>Nombre:</strong> " . htmlspecialchars($nombre) . " " . htmlspecialchars($apellido) . "<br>";
    $cuerpoMensaje .= "<strong>Email:</strong> " . htmlspecialchars($email) . "<br>";
    $cuerpoMensaje .= "<strong>Teléfono:</strong> " . htmlspecialchars($telefono) . "<br>";
    $cuerpoMensaje .= "<strong>Mensaje:</strong><br>" . nl2br(htmlspecialchars($mensaje));

    // Envío del correo
    if (mail($destinatario, $asunto, $cuerpoMensaje, $headers)) {
        echo "<script>alert('Mensaje enviado correctamente'); window.location.href='contact.html';</script>";
    } else {
        echo "<script>alert('Error al enviar el mensaje. Intenta de nuevo.'); window.history.back();</script>";
    }
}
?>
