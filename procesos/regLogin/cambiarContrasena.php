<?php
require_once "../../clases/Conexion.php";
require_once "../../clases/Usuarios.php";

$obj = new Usuarios();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener la nueva contraseña del formulario
    $nuevaContrasena = $_POST['nueva_contrasena'];

    // Cambiar el email por el del administrador registrado
    $email = 'admin';

    // Cambiar la contraseña
    $resultado = $obj->cambiarContrasena($email, $nuevaContrasena);

    if ($resultado) {
        echo "1"; // Éxito
    } else {
        echo "Error al cambiar la contraseña";
    }
} else {
    echo "Acceso denegado";
}
?>
