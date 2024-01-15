<?php
require('admin/php/conexion.php');

$usuario = $_POST['user'];
$contrasena = $_POST['pass'];

try {
    $sql = $conn->prepare('SELECT u.Id_usuario, u.correo_usuario, u.contrasena_usuario, u.nombre_usuario, u.apellidos_usuario, u.siglas_usuario, u.estado_usuario, u.firma_usuario, u.proceso_usuario_fk, u.tipo_usuario_fk, p.id_proceso, p.siglas_proceso, p.nombre_proceso, p.estado_proceso, t.id_tipo_usuario, t.rol_usuario, t.admin_acpm, t.radicar_acpm, t.admin_sadoc, t.consultar_sadoc, t.ordenes, t.admin_compras, t.pagar_ordenes, t.analisis_cotizacion, t.radicar_orden, t.firmar_orden, t.evaluar_proveedor, t.admin_activos, t.consultar_activos, t.ingresar_activos, t.editar_activos, c.id_cargo, c.nombre_cargo FROM usuarios u INNER JOIN proceso p ON u.proceso_usuario_fk = p.id_proceso INNER JOIN tipo_usuario t ON u.tipo_usuario_fk = t.id_tipo_usuario INNER JOIN cargos c ON u.id_cargo_fk = c.id_cargo WHERE u.correo_usuario=:usuario AND u.estado_usuario = "activo"');
    $sql->execute(array('usuario' => $usuario));
    $resultado = $sql->fetch();

    if ($resultado && password_verify($contrasena, $resultado['contrasena_usuario'])) {
        // La contraseña es válida
        session_start();
        $_SESSION['ingreso'] = true;
        $_SESSION['Id'] = $resultado['Id_usuario'];
        $_SESSION['nombre_usuario'] = $resultado['nombre_usuario'];
        $_SESSION['apellidos_usuario'] = $resultado['apellidos_usuario'];
        $_SESSION['siglas_usuario'] = $resultado['siglas_usuario'];
        $_SESSION['estado_usuario'] = $resultado['estado_usuario'];
        $_SESSION['firma_usuario'] = $resultado['firma_usuario'];
        $_SESSION['proceso_fk'] = $resultado['siglas_proceso'];
        $_SESSION['rol_usuario'] = $resultado['rol_usuario'];
        $_SESSION['admin_acpm'] = $resultado['admin_acpm'];
        $_SESSION['radicar_acpm'] = $resultado['radicar_acpm'];
        $_SESSION['admin_sadoc'] = $resultado['admin_sadoc'];
        $_SESSION['consultar_sadoc'] = $resultado['consultar_sadoc'];
        $_SESSION['ordenes'] = $resultado['ordenes'];
        $_SESSION['admin_compras'] = $resultado['admin_compras'];
        $_SESSION['pagar_ordenes'] = $resultado['pagar_ordenes'];
        $_SESSION['analisis_cotizacion'] = $resultado['analisis_cotizacion'];
        $_SESSION['radicar_orden'] = $resultado['radicar_orden'];
        $_SESSION['firmar_orden'] = $resultado['firmar_orden'];
        $_SESSION['evaluar_proveedor'] = $resultado['evaluar_proveedor'];
        $_SESSION['admin_activos'] = $resultado['admin_activos'];
        $_SESSION['consultar_activos'] = $resultado['consultar_activos'];
        $_SESSION['ingresar_activos'] = $resultado['ingresar_activos'];
        $_SESSION['editar_activos'] = $resultado['editar_activos'];
        $_SESSION['nombre_proceso'] = $resultado['nombre_proceso'];
        $_SESSION['correo_usuario'] = $resultado['correo_usuario'];
        $_SESSION['nombre_cargo'] = $resultado['nombre_cargo'];

        header('location: admin/index.php');
    } else {
        // La contraseña es incorrecta
        echo '<script>alert("Has tenido errores en tus datos. Intenta de nuevo..."); </script>';
        echo '<script> window.location="index.php"; </script>';
    }

    $conn = null; // cerrar la conexión
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>
