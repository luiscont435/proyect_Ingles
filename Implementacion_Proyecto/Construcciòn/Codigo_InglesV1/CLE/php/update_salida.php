<?php
date_default_timezone_set('America/Mexico_City');
include('../php/conexion.php');
include('is_logged.php');
include('../escpos/autoload.php'); //Nota: si renombraste la carpeta a algo diferente de "ticket" cambia el nombre en esta línea
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
$filtrarLink = $_POST['valorLink'];
$filtrarObservaciones = $_POST['valorObservaciones'];
$filtrarPrecio = $_POST['valorPrecio'];
$filtrarIdDispositivo = $_POST['valorIdDispositivo'];
$filtrarTecnico = $_POST['valorTecnico'];
$filtrarEstatus = $_POST['valorEstatus'];
$Imprimir = $_POST['valorImprimir'];


//Filtro anti-XSS
$caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/");
$caracteres_buenos = array("& lt;", "& gt;", "& quot;", "& #x27;", "& #x2F;", "& #060;", "& #062;", "& #039;", "& #047;");

$Observaciones = str_replace($caracteres_malos, $caracteres_buenos, $filtrarObservaciones);
$Precio = str_replace($caracteres_malos, $caracteres_buenos, $filtrarPrecio);
$IdDispositivo = str_replace($caracteres_malos, $caracteres_buenos, $filtrarIdDispositivo);
$Tecnico = str_replace($caracteres_malos, $caracteres_buenos, $filtrarTecnico);
$Estatus = str_replace($caracteres_malos, $caracteres_buenos, $filtrarEstatus);
$FechaSalida = date('Y-m-d');

$mensaje = "";
$sql = "UPDATE dispositivos SET observaciones='$Observaciones', tecnico='$Tecnico', estatus='$Estatus', fecha_salida='$FechaSalida', link='$filtrarLink', precio='$Precio' WHERE id_dispositivo='$IdDispositivo'";

if(mysqli_query($conn, $sql)){
	$mensaje = '<script>M.toast({html:"Se ha actualizado correctamente el folio.", classes: "rounded"})</script>';
}else{
	$mensaje = '<script>M.toast({html:"Ha ocurrido un error.", classes: "rounded"})</script>';
}

echo $mensaje;
mysqli_close($conn);
?>