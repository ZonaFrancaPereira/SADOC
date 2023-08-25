<?php
include("../functions.php");	


if (isset($_POST['enviar_orden'])) {

	$total_propina=$_POST['total_propina'];
	$orderIDMesa=$_POST['orderIDMesa'];
	$items1 = ($_POST['pago']);
	$items2 = ($_POST['orderID']);
	$items3 = ($_POST['id_caja_fk']);
	$items4 = ($_POST['monto_recibido']);
	

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

?>