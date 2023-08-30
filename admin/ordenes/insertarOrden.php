<?php
include("../functions.php");	


if (isset($_POST['enviar_orden '])) {

	$fecha_orden=$_POST['fecha_orden'];
	$id_proveedor_fk=$_POST['id_proveedor_fk'];
	$forma_pago=$_POST['forma_pago'];
	$tiempo_pago=$_POST['tiempo_pago'];
	$porcentaje_anticipo=$_POST['porcentaje_anticipo'];
	$condiciones_negociacion=$_POST['condiciones_negociacion'];
	$comentario_orden=$_POST['comentario_orden'];
	$tiempo_entrega=$_POST['tiempo_entrega'];
	$total_orden=$_POST['total_orden'];
	if($total_orden>=1000000){
		$estado_orden="Analisis de Cotizacion";
	}else{
		$estado_orden="Proceso";
	}
	//INSERTAR LOS DATOS QUE NO SE REPITEN EN LA ORDEN
	try {
		$stmt = $conn->prepare('INSERT INTO orden_compra(fecha_orden,forma_pago,tiempo_pago,porcentaje_anticipo,
		 condiciones_negociacion,comentario_orden,tiempo_entrega
		,total_orden,analisis_cotizacion,estado_orden,id_cotizante, id_proveedor_fk)
		 VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)');
		$stmt->bindParam(1, $fecha_orden);
		$stmt->bindParam(2, $forma_pago);
		$stmt->bindParam(3, $descripcion_fuente);
		$stmt->bindParam(4, $tiempo_pago);
		$stmt->bindParam(5, $porcentaje_anticipo);
		$stmt->bindParam(6, $condiciones_negociacion);
		$stmt->bindParam(7, $comentario_orden);
		$stmt->bindParam(8, $tiempo_entrega);
		$stmt->bindParam(9, $total_orden);
		$stmt->bindParam(10, $analisis_cotizacion);
		$stmt->bindParam(11, $id_cotizante);
		$stmt->bindParam(12, $id_proveedor_fk);
	
		if ($stmt->execute()){
			echo "1";
		}else{
			echo "ERROR";
		}
	} catch(PDOException $e){
		echo "Se ha producido un error al intentar conectar al servidor MySQL: ".$e->getMessage();
	}
	$items1 = ($_POST['articulo_compra']);
	$items2 = ($_POST['cantidad_orden']);
	$items3 = ($_POST['valor_neto']);
	$items4 = ($_POST['valor_iva']);
	$items5 = ($_POST['valor_total']);
	$items6 = ($_POST['observaciones_articulo']);
	

	

	while(true) {

            //// RECUPERAR LOS VALORES DE LOS ARREGLOS ////////
		$item1 = current($items1);
		$item2 = current($items2);
		$item3 = current($items3);
		$item4 = current($items4);
		$item5 = ($item5 = $item4-$item1);
		


            ////// ASIGNARLOS A VARIABLES ///////////////////
		$pago= (($item1 !== false) ? $item1 : ", &nbsp;");
		$orderID= $item2;
		$id_caja_fk= (($item3 !== false) ? $item3 : ", &nbsp;");
		$monto_recibido= (($item4 !== false) ? $item4 : ", &nbsp;");
		$devolucion= $item5;
            //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
		$valores='("'.$orderID.'","'.$id_caja_fk.'","'.$monto_recibido.'","'.$pago.'","'.$devolucion.'"),';

            //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA /////////////////////
		$valoresQ= substr($valores, 0, -1);

            ///////// QUERY DE INSERCIÓN ////////////////////////////
		$sql = "INSERT INTO pagos (orderID, id_caja_fk,monto_recibido,pago_orden,devuelto) 
		VALUES $valoresQ";

		$sqlconnection->query($sql);
        // Up! Next Value
		$item1 = next( $items1 );

		$item3 = next( $items3 );
		$item4 = next( $items4 );

            // Check terminator
		if($item1 === false && $item3 === false && $item4 === false ) break;

	}

	
}
