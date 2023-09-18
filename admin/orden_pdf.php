<?php
include('includes/connection.php');
require('fpdf/fpdf.php');
date_default_timezone_set('America/Bogota');
class PDF extends FPDF
{

	function Header()
	{
        //$this->Image('fondo.png',-10,-1,110);
		$this->Image('img/logo.png',240,4,30);
		$this->SetY(15);
		$this->SetX(19);
		$this->SetFont('Arial','B',20);
		$this->Cell(89, 8,  utf8_decode('SISTEMA DE GESTIÓN DE SEGURIDAD VIAL'),0,1);
		$this->SetY(20);
		$this->SetX(19);
		$this->SetFont('Arial','',12);
		$this->Cell(40, 8, utf8_decode('REGISTRO PREOPERATIVO'));
		$this->Ln(5);
	}
	function Footer()
	{
		$this->SetFont('helvetica', 'B', 8);
		$this->SetY(-15);
		$this->Cell(95,5,utf8_decode('Página ').$this->PageNo().' / {nb}',0,0,'L');
		$this->Cell(170,5,date('d/m/Y | g:i:a') ,00,1,'R');
		$this->Line(10,287,200,287);
		$this->Cell(0,5,utf8_decode("AyL Riesgos y Seguros © Todos los derechos reservados."),0,0,"C");

	}
	    // Tabla horizontal
    function HorizontalTable($header, $data)
    {
        // Cabecera
        $this->SetFont('Arial', 'B', 10);
        foreach ($header as $col) {
            $this->Cell(70, 15, $col, 1);
        }
        $this->Ln();

        // Datos
        $this->SetFont('Arial', '', 10);
        foreach ($data as $row) {
            foreach ($row as $col) {
                $this->Cell(70, 15, $col, 1);
            }
            $this->Ln();
        }
    }
}

$id_registro=$_GET['id_registro'];
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetDrawColor(33, 47, 61); // Color rojo
$pdf->SetFillColor(255, 0, 0); // Color de relleno rojo
$pdf->SetLineWidth(1); // Ancho de línea de 1 punto
$pdf->SetFillColor(255, 255, 255); // Establecer el color de relleno en blanco
 $pdf->Line(0, 45, 340, 45); // 50mm from each edge
     // Salto de línea
 $pdf->Ln(30);
//CUERPO DE LA TABLA
$pdf->SetFillColor(233, 229, 235);//color de fondo rgb
$pdf->SetDrawColor(61, 61, 61);//color de linea  rgb
$pdf->SetFont('Arial','',10);
$displayStaffQuery = "SELECT r.id_registro, r.placa_casco, r.fecha_registro, r.baja, r.alta, r.stop, r.direccionales, r.pito, r.frenos, r.guaya_acelerador, r.guaya_clutch, r.estado_llantas, r.nivel_aceite, r.kit_arrastre, r.chaleco, r.espejos, r.combustible, r.boton_panico, r.soat, r.tecnomecanica, r.tarjeta_propiedad, r.observaciones, r.firma, r.id_vehiculo_a_fk,va.id_asignacion, va.fecha_asignacion, va.id_vehiculo_fk, va.id_usuario_fk,u.id, u.identificacion, u.username, u.firstname,u.lastname,u.email,v.id_vehiculo, v.placa, v.color, v.marca, v.motor, v.modelo, v.soat, v.tecnomecanica, v.rodamiento,v.ciudad, v.estado, v.observaciones_vehiculo FROM registro r
INNER JOIN asignacion_vehiculo va
ON r.id_vehiculo_a_fk=va.id_asignacion
INNER JOIN users u 
ON va.id_usuario_fk=u.id
INNER JOIN vehiculo v
ON va.id_vehiculo_fk=v.id_vehiculo WHERE r.id_registro='{$id_registro}'
";
if ($result33 = $sqlconnection->query($displayStaffQuery)) {

	if ($result33->num_rows == 0) {
		echo '<div class="alert alert-info alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h5><i class="icon fas fa-info"></i> Atención!</h5>
		Actualmente no hay ningun vehiculo asignado.
		</div>';

	}
    //CONTADOR PARA QUE EL PRIMER SLIDER SEA EL ACTIVO
	while($filam = $result33->fetch_array(MYSQLI_ASSOC)) {
		$fecha_registro=$filam['fecha_registro'];
		$placa=$filam['placa'];
		$estado=$filam['estado'];
		$ciudad=$filam['ciudad'];
		$color=$filam['color'];
		$firstname=$filam['firstname'];
		$identificacion=$filam['identificacion'];
		$id_registro=$filam['id_registro'];
		$lastname=$filam['lastname'];
		$firma=$filam['firma'];
		$baja=$filam['baja']; 
		$alta=$filam['alta'];
		$stop=$filam['stop'];
		$direccionales=$filam['direccionales'];
		$pito=$filam['pito'];
		$frenos=$filam['frenos'];
		$guaya_acelerador=$filam['guaya_acelerador'];
		$guaya_clutch=$filam['guaya_clutch'];
		$estado_llantas=$filam['estado_llantas'];
		$nivel_aceite=$filam['nivel_aceite'];
		$kit_arrastre=$filam['kit_arrastre'];
		$chaleco=$filam['chaleco'];
		$espejos=$filam['espejos'];
		$combustible=$filam['combustible'];
		$boton_panico=$filam['boton_panico'];
		$soat=$filam['soat'];
		$tecnomecanica=$filam['tecnomecanica'];
		$tarjeta_propiedad=$filam['tarjeta_propiedad'];
		$observaciones=$filam['observaciones'];
	$header = array('  Fecha Registro : '.$fecha_registro. '', 'Identificacion : '.$identificacion.'', 'Conductor : '.$firstname.' '.$lastname.'','PLACA : '.$placa);
$data = array(
    array('Guaya de Clutch : '.$guaya_clutch. '', 'Luz Baja : '.$baja. '', 'Luz Alta : '.$alta.'','Stop : '.$stop.''),
    array('Direccionales : '.$direccionales.'', 'Pito : '.$pito.'', 'Frenos : '.$frenos. '','Guaya Acelerador : '.$guaya_acelerador.''),
    array('Estado de Llantas : '.$estado_llantas.'', 'Nivel de Aceite : '.$nivel_aceite.'', 'Kit de Arrastre : '.$kit_arrastre.'','Chaleco : '.$chaleco.''),
    array('Espejos : '.$espejos. '','Combustible : '.$combustible.'','Boton Panico : '.$boton_panico.'','Soat : '.$soat.''),
    array('Tecno/Mecanica : '.$tecnomecanica.'','Tarjeta de Propiedad : '.$tarjeta_propiedad.'','Observaciones: '.$observaciones.'','Ciudad: '.$ciudad.'')
);
$pdf->HorizontalTable($header, $data);
	}
}
if($firma!=""){
	$pdf->Image('firmas/'.$firma, 50, 155,  150, 27);
}
$pdf->setY(180);
$pdf->setX(10);
$pdf->Cell(5,0,'FIRMA CONDUCTOR ___________________________________________________________________________________________________.' );


$pdf->Output();

?>