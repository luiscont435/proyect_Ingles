<?php
include('../php/conexion.php');

	$Nombre = $conn->real_escape_string($_POST['valorNombre']);
	$NoControl = $conn->real_escape_string($_POST['valorNoControl']);
	$Carrera = $conn->real_escape_string($_POST['valorCarrera']);
	$IdAlumno = $conn->real_escape_string($_POST['valorIdAlumno']);

$sql = "UPDATE alumnos SET no_control = '$NoControl', Nombre = '$Nombre', Carrera = '$Carrera' WHERE id_alumno = '$IdAlumno'";
if(mysqli_query($conn, $sql)){
		$mensaje = '<script>M.toast({html :"Se ha actualizado la informacion correctamente.", classes: "rounded"})</script>';
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
?>