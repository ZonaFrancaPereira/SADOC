<?php 

require('admin/php/conexion.php');
$usuario= $_POST['user'];
$contrasena= $_POST['pass'];

try {

   $sql =$conn->prepare('SELECT u.Id_usuario, u.correo_usuario, u.contrasena_usuario, u.nombre_usuario, u.apellidos_usuario, u.siglas_usuario, u.estado_usuario, u.firma_usuario, u.proceso_usuario_fk, u.tipo_usuario_fk,p.id_proceso, p.siglas_proceso, p.nombre_proceso, p.estado_proceso, t.id_tipo_usuario, t.rol_usuario,t.admin_acpm, t.radicar_acpm, t.admin_sadoc, t.consultar_sadoc,t.ordenes, t.admin_compras, t.pagar_ordenes, t.analisis_cotizacion, t.radicar_orden, t.firmar_orden, t.evaluar_proveedor,t.admin_activos,t.consultar_activos, t.ingresar_activos, t.editar_activos, c.id_cargo,c.nombre_cargo FROM usuarios u
    INNER JOIN proceso p
    ON u.proceso_usuario_fk = p.id_proceso
    INNER JOIN tipo_usuario t 
    ON u.tipo_usuario_fk = t.id_tipo_usuario
    INNER JOIN cargos c
    ON u.id_cargo_fk = c.id_cargo
    WHERE u.correo_usuario=:usuario AND u.contrasena_usuario=:contrasena AND u.estado_usuario = "activo"');

   $resultado = $sql->execute(array('usuario'=>$usuario, 'contrasena'=>$contrasena));
   $resultado = $sql->fetchALL();
   $num = $sql->rowCount();

   if ($num >=1) {

    foreach ($resultado as $fila) {

      session_start();
      $_SESSION['ingreso']= true;
      $_SESSION['Id']= $fila['Id_usuario'];
      $_SESSION['nombre_usuario']= $fila['nombre_usuario'];
      $_SESSION['apellidos_usuario']= $fila['apellidos_usuario'];
      $_SESSION['proceso_fk']= $fila['siglas_proceso'];
      $_SESSION['siglas_usuario']= $fila['siglas_usuario'];
      $_SESSION['nombre_cargo']= $fila['nombre_cargo'];
      $_SESSION['rol_usuario']= $fila['rol_usuario'];
      $_SESSION['admin_acpm']= $fila['admin_acpm'];
      $_SESSION['radicar_acpm']= $fila['radicar_acpm'];
      $_SESSION['admin_sadoc']= $fila['admin_sadoc'];
      $_SESSION['consultar_sadoc']= $fila['consultar_sadoc'];
      $_SESSION['ordenes']= $fila['ordenes'];
      $_SESSION['admin_compras']= $fila['admin_compras'];
      $_SESSION['pagar_ordenes']= $fila['pagar_ordenes'];
      $_SESSION['analisis_cotizacion']= $fila['analisis_cotizacion'];
      $_SESSION['radicar_orden']= $fila['radicar_orden'];
      $_SESSION['firmar_orden']= $fila['firmar_orden'];
      $_SESSION['evaluar_proveedor']= $fila['evaluar_proveedor'];
      $_SESSION['admin_activos']= $fila['admin_activos'];
      $_SESSION['consultar_activos']= $fila['consultar_activos'];
      $_SESSION['ingresar_activos']= $fila['ingresar_activos'];
      $_SESSION['editar_activos']= $fila['editar_activos'];
      $cargo = $fila['siglas_proceso'];
  }

  header('location: admin/index.php');

}else{
    echo '<script>alert("has tenido errores en tus datos intente de nuevo..."); </script>';
    echo '<script> window.location="index.php"; </script>';
}

        $conn =null; //cerrar la conexion

    }catch (PDOException $e) {
      echo "error:".$e->getMessage();
      exit();
  }
?>