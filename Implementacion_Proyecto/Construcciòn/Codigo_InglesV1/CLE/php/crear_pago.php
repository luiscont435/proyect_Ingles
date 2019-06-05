<?php
include('../php/conexion.php');
session_start();
date_default_timezone_set('America/Mexico_City');

$Cantidad = $conn->real_escape_string($_POST['valorCantidad']);
$Grado = $conn->real_escape_string($_POST['valorGrado']);
$IdAlumno = $conn->real_escape_string($_POST['valorIdAlumno']);
$Tipo = $conn->real_escape_string($_POST['valorTipo']);
$Fecha = date('Y-m-d'); 
$Usuario = $_SESSION['usuario'];


$aux= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pagos WHERE fecha = '$Fecha' AND cantidad = '$Cantidad' AND id_alumno='$IdAlumno'  AND tipo ='$Tipo' AND grado = '$Grado'"));
if($aux<=0 or $aux==null){
	$sql = "INSERT INTO pagos (id_alumno, cantidad, grado, tipo, fecha, usuario) VALUES ('$IdAlumno', '$Cantidad', '$Grado', '$Tipo', '$Fecha', '$Usuario')";
	if (mysqli_query($conn, $sql)) {
		echo '<script>M.toast({html : "Se realizo el pago correctamente.", classes: "rounded"})</script>';
	}
}else{
	echo '<script>M.toast({html : "Ya se encuentra un pago registrada con los mismos valores el día de hoy.", classes: "rounded"})</script>';
}
?>
	<div id="mostrar_pagos">
	  <table>
	  	<thead>
	  	  <tr>
	  	  	<th>#</th>
            <th>Cantidad</th>
            <th>Tipo</th>
            <th>Grado</th>
            <th>Fecha</th>
            <th>Usuario</th>
            <th>Borrar</th>
	  	  </tr>
	  	</thead>
	  	<tbody>
	  	<?php
	  	  $sql = mysqli_query($conn, "SELECT * FROM pagos WHERE id_alumno = $IdAlumno ORDER BY id_pago DESC");
	  	  $aux = mysqli_num_rows($sql);
	      if($aux>0){
	      while($pagos = mysqli_fetch_array($sql)){
	      	$tipo = "Libro";
	      	if ($pagos['tipo'] == 2) {
	      		$tipo = "Curso";
	      	}
	  	?>
	  	  <tr>
	  	  	<td><b><?php echo $aux;?></b></td>
	  	  	<td>$<?php echo $pagos['cantidad'];?></td>
	  	  	<td><?php echo $tipo;?></td>
	  	  	<td><?php echo $pagos['grado'];?>°</td>
	  	  	<td><?php echo $pagos['fecha'];?></td>
	  	  	<td><?php echo $pagos['usuario'];?></td>
	  	  	<td><a onclick="borrar(<?php echo $pagos['id_pago'];?>);" class="btn btn-floating red darken-1 waves-effect waves-light"><i class="material-icons">delete</i></a>
        </td>
	  	  </tr>
	  	  <?php
	      $aux--;
	      }//Fin while
	      }else{
	      echo "<center><b><h3>Este alumno aún no ha registrado pagos</h3></b></center>";
	    }
	    ?> 
	  	</tbody>			
	  </table>
	</div>