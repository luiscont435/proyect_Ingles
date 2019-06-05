<!DOCTYPE html>
<html>
<head>
	<title>CLE | Insertar Alumno</title>
<?php
include("Nav.php");
if (isset($_POST['enviar'])) {
	include ("../php/conexion.php");
	$archivo = $_FILES["archivo"]["name"];
	$archivo_copiado = $_FILES["archivo"]["tmp_name"];
	$archivo_guardado = "copia_".$archivo;

	
	copy($archivo_copiado, $archivo_guardado);

	if (file_exists($archivo_guardado)) {//crear copia en server
		$fp = fopen($archivo_guardado, "r");//abrir un archivo
		$rows = 0;
		$Si = 0;
		$No = 0;
		while ($datos = fgetcsv($fp, 1000, ",")) {
			$rows ++;
			if ($rows > 1) {
			//echo $datos[4]."<br>";
			$no_control = str_replace("'", "", $datos[0]);
			$Nombre = str_replace("'", "", $datos[1]);
			$Carrera = str_replace("'", "", $datos[4]);
			
			$consulta = mysqli_query($conn, "SELECT * FROM alumnos WHERE no_control = '$no_control'");
			$filas = mysqli_num_rows($consulta);
			if ($filas > 0) {
				$No++;
				echo '<script>M.toast({html:"Ya se encuentra repetido.", classes: "rounded"})</script>';
			}else{

				if (mysqli_query($conn, "INSERT INTO alumnos (no_control, Nombre, Carrera) VALUES ('$no_control', '$Nombre', '$Carrera')")) {
					$Si ++;
				}else{
					$No++;
				}
			}
		}
		}
	}else{
		echo '<script>M.toast({html:"Elejir un archivo.", classes: "rounded"})</script>';
	}
	$todo = $Si+$No;
echo '<script>M.toast({html:"Resultados: '.$Si.' / '.$todo.'", classes: "rounded"})</script>';
}
?>
<script>
	function insert_alumnos() {
	    var textoNombre = $("input#nombre").val();
	    var textoApellidos = $("input#Apellidos").val();
	    var textoNoControl = $("input#no_control").val();
	    var textoCarrera = $("select#carrera").val();
	  
	    if (textoNombre == "") {
	      M.toast({html :"Por favor ingrese el nombre del alumno.", classes: "rounded"});
	    }else if(textoApellidos == ""){
	      M.toast({html :"Por favor ingrese los apelidos del alumno.", classes: "rounded"});
	    }else if(textoNoControl == ""){
	      M.toast({html :"Ingrese el numero de control.", classes: "rounded"});
	    }else if(textoCarrera == 0){
	      M.toast({html :"Seleccione una carrera.", classes: "rounded"});
	    }else{
	      $.post("../php/insert_alumno.php", {
	          valorNombre: textoApellidos+" "+textoNombre,
	          valorNoControl: textoNoControl,
	          valorCarrera: textoCarrera
	        }, function(mensaje) {
	            $("#resultado_Alumno").html(mensaje);
	        }); 
	    }
	};
</script>
</head>
<body>
	<div class="container">
		<div class="row">
		<div class="col s5 m3 l3">
			<h2>Archivo</h2>
		</div>
		<form class="col s7 m9 l9" action="insertar_alumno.php" method="post" enctype="multipart/form-data"><br><br>
		    <input type="file" name="archivo" class="col s8 m8 l8">
		    <button class="btn waves-effect waves-light indigo col s3 m3 l3" type="submit" name="enviar">SUBIR ARCHIVO
			    <i class="material-icons right">send</i>
			</button>
		</form>
		</div>
		<div id="resultado_usuarios"></div>
		<div id="resultado_Alumno"></div>
		<div class="row">
			<h2>Crear Alumno:</h2>
		</div>
		<div class="row">
			<div class="input-field col s12 m6 l6" >
				<i class="material-icons prefix">account_circle</i>
				<input type="text" name="nombre" id="nombre">
				<label for="nombre">Nombre</label>
			</div>
			<div class="input-field col s12 m6 l6">
				<i class="material-icons prefix">edit</i>
				<input type="text" name="Apellidos" id="Apellidos">
				<label for="Apellidos">Apellidos</label>
			</div>
			<div class="input-field col s12 m6 l6">
				<i class="material-icons prefix">lock_outline</i>
				<input type="text" name="no_control" id="no_control">
				<label for="no_control">No. Control</label>
			</div>
			<div class="input-field col s12 m6 l6"><br>	
		        <select id="carrera" class="browser-default">
		          <option value="0" selected>Seleccione Una Carrera</option>
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
		        <a onclick="insert_alumnos();" class="waves-effect waves-light btn indigo right"><i class="material-icons right">send</i>ENVIAR</a>
		    </div>
		</div><br>
	</div>
</body>
</html>