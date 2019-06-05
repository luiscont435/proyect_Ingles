<?php
	include('../php/conexion.php');

	date_default_timezone_set('America/Mexico_City');
	$Nombre = $conn->real_escape_string($_POST['valorNombre']);
	$NoControl = $conn->real_escape_string($_POST['valorNoControl']);
	$Carrera = $conn->real_escape_string($_POST['valorCarrera']);

	//Variable vacía (para evitar los E_NOTICE)
	$mensaje = "";

	$sql_alumnos = "SELECT * FROM alumnos WHERE Nombre='$Nombre'";

	if(mysqli_num_rows(mysqli_query($conn, $sql_alumnos))>0){
	    $mensaje = '<script>M.toast({html :"Ya fue registrado un alumno igual.", classes: "rounded"})</script>';
	}else{
		$sql = "INSERT INTO alumnos (no_control, Nombre, Carrera) VALUES ('$NoControl', '$Nombre', '$Carrera')";
		if (mysqli_query($conn, $sql)) {
			$mensaje = '<script>M.toast({html :"El almuno se registró satisfactoriamente.", classes: "rounded"})</script>';
			?>
			  <script>    
			    var a = document.createElement("a");
			      a.href = "../views/alumnos.php";
			      a.click();
			  </script>
			<?php
		}else{
			$mensaje = '<script>M.toast({html :"Ha ocurrido un error.", classes: "rounded"})</script>';	
		}
	}
?>