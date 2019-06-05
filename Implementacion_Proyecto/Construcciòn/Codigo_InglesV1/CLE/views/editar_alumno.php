<!DOCTYPE html>
<html>
<head>
	<title>CLE | Editar Alumno</title>
<?php
include('Nav.php');
$id_alumno = $_POST['no_alumno'];
$alumno = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM alumnos WHERE id_alumno = '$id_alumno'"));
?>
<script>
	function update_alumno() {
	    var textoNombre = $("input#nombre").val()
	    var textoNoControl = $("input#no_control").val();
	    var textoCarrera = $("select#carrera").val();
	    textoIdAlumno = <?php echo $id_alumno; ?>;
	  
	    if (textoNombre == "") {
	      M.toast({html :"Por favor ingrese el nombre del alumno.", classes: "rounded"});
	    }else if(textoNoControl == ""){
	      M.toast({html :"Ingrese el numero de control.", classes: "rounded"});
	    }else if(textoCarrera == 0){
	      M.toast({html :"Seleccione una carrera.", classes: "rounded"});
	    }else{
	      $.post("../php/update_alumno.php", {
	          valorNombre: textoNombre,
	          valorNoControl: textoNoControl,
	          valorCarrera: textoCarrera,
	          valorIdAlumno: textoIdAlumno
	        }, function(mensaje) {
	            $("#resultado_Alumno").html(mensaje);
	        }); 
	    }
	};
</script>
</head>
<body>
	<div class="container">
		<div id="resultado_Alumno"></div>
		<div class="row">
			<h2>Editar Alumno</h2>
		</div>
		<div class="row">
			<div class="input-field col s12 m6 l6" >
				<i class="material-icons prefix">account_circle</i>
				<input type="text" name="nombre" id="nombre" value="<?php echo $alumno['Nombre']; ?>">
				<label for="nombre">Nombre</label>
			</div>
			<div class="input-field col s12 m6 l6">
				<i class="material-icons prefix">lock_outline</i>
				<input type="text" name="no_control" id="no_control" value="<?php echo $alumno['no_control'];?>">
				<label for="no_control">No. Control</label>
			</div>
			<div class="input-field col s12 m6 l6"><br>	
		        <select id="carrera" class="browser-default">
		          <option value="<?php echo $alumno['Carrera']; ?>" selected><?php echo $alumno['Carrera']; ?></option>
		          <option value="INGENERIA EN GESTION EMPRESARIAL">INGENERIA EN GESTION EMPRESARIAL</option>
		          <option value="INGENERIA EN SISTEMAS COMPUTACIONALES">INGENERIA EN SISTEMAS COMPUTACIONALES</option>
		          <option value="INGENERIA INDUSTRIAL">INGENERIA INDUSTRIAL</option>
		          <option value="INGENERIA INFORMATICA">INGENERIA INFORMATICA</option>
		          <option value="LICENCIATURA EN ADMINISTRACION">LICENCIATURA EN ADMINISTRACION</option>
		          <option value="TECNICO SUPERIOR EN MINERIA">TECNICO SUPERIOR EN MINERIA</option>
		          <option value="ING. EN GESTION SAIN ALTO">ING. EN GESTION SAIN ALTO</option>
		          <option value="INGENERIA EN GESTION EMPRESARIAL ED. DISTANCIA">INGENERIA EN GESTION EMPRESARIAL ED. DISTANCIA</option>
		          <option value="Otros"> Otros</option>
		        </select>
		    </div>
			<div>
		        <a onclick="update_alumno();" class="waves-effect waves-light btn indigo right"><i class="material-icons right">send</i>GUARDAR</a>
		    </div>
		</div><br>
	</div>
</body>
</html>