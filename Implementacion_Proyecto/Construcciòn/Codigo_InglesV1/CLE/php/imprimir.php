<?php
include('../php/conexion.php');
$id_pago = $_GET['IdPago'];

//Incluimos la libreria fpdf
include("../fpdf/fpdf.php");
include("is_logged.php");

class PDF extends FPDF{
   //Cabecera de página
   function Header(){

    }

    function body(){
        global $conn;
        global $id_pago;
        
        $this->Ln(15);
        $this->Image('../img/logo.jpg',38,14,40);
        $this->Image('../img/Itszo.png',138,14,30);
        $this->SetFont('Arial','B',18);
        $this->Ln(20);
        $this->MultiCell(194,4, utf8_decode('PAGO No.'.$id_pago),0,'C',false);
        $this->Ln(10);

        $pago = mysqli_fetch_array( mysqli_query($conn, "SELECT * FROM pagos WHERE id_pago = $id_pago"));
        $id_alumno = $pago['id_alumno']; 
        $alumno = mysqli_fetch_array( mysqli_query($conn, "SELECT * FROM alumnos WHERE id_alumno = $id_alumno"));
        $tipo1 = $pago['tipo'];
        $tipo = "CURSO";
        if ($tipo1 == 1) {
            $tipo = "LIBRO";
        }

        $this->MultiCell(200,14, utf8_decode('Fecha: '.$pago['fecha']).' ',4,'R',false);
        $this->Ln(10);
        $this->MultiCell(200,4, utf8_decode('Alumno: '.$alumno['Nombre']),0,'L',false);
        $this->Ln(5);
        $this->MultiCell(200,4, utf8_decode('No Control: '.$alumno['no_control']),0,'L',false);
        $this->Ln(5);
        $this->MultiCell(200,4, utf8_decode('Carrera: '.$alumno['Carrera']),0,'L',false);
        $this->Ln(12);
        $this->MultiCell(200,4, utf8_decode('Tipo: '.$tipo),0,'L',false);
        $this->Ln(5);
        $this->MultiCell(200,4, utf8_decode('Cantidad: '.$pago['cantidad']),0,'L',false);
        $this->Ln(5);
        
        mysqli_close($conn);

    }

    function footer(){

    }
}

//Creación del objeto de la clase heredada
$pdf=new PDF();
$pdf->AddPage();
$pdf->body();
$pdf->setTitle('RUTA REDES');
//Aquí escribimos lo que deseamos mostrar...
$pdf->Output();
?>