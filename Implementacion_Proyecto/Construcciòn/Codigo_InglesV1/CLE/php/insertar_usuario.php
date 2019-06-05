<?php
//include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
// Checamos la versión de PHP que esta usando el servidor

if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // Si estamos usando una versión de PHP superior entonces usamos la API para encriptar la contrasela con el archivo: password_api_compatibility_library.php
    include_once("password_compatibility_library.php");
}
include("../php/conexion.php");//Contiene las variables de configuración para conectar a la base de datos
	$caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/",";","?", "php", "echo","$","{","}","=");
    $caracteres_buenos = array("", "", "", "", "", "", "", "", "","","", "","","", "","","");
			
	// Eliminamos cualquier tipo de código HTML o JavaScript
	$valorNombre = $conn->real_escape_string($_POST["valorNombre"]);
	$valorEmail = $conn->real_escape_string($_POST["valorEmail"]);
	$valorUsuario = $conn->real_escape_string($_POST["valorUsuario"]);
	$valorPassword = $conn->real_escape_string($_POST["valorPassword"]);

	$valorNombre = str_replace($caracteres_malos, $caracteres_buenos, $valorNombre);
	$valorEmail = str_replace($caracteres_malos, $caracteres_buenos, $valorEmail);
	$valorUsuario = str_replace($caracteres_malos, $caracteres_buenos, $valorUsuario);
	$valorPassword = str_replace($caracteres_malos, $caracteres_buenos, $valorPassword);

	$valorPassword_hash = password_hash($valorPassword, PASSWORD_DEFAULT);

	$check = mysqli_query($conn, "SELECT * FROM usuarios WHERE Nombre = '$valorNombre' AND usuario = '$valorUsuario' AND email = '$valorEmail'");
	$repite=mysqli_num_rows($check);
	if ($repite > 0) {
		echo '<script>M.toast({html:"Este usuario o correo ya existe en la base de datos.", classes: "rounded"})</script>';
	}else{
		$sql = "INSERT INTO usuarios(Nombre, password, usuario, email) VALUES ('$valorNombre','$valorPassword_hash','$valorUsuario','$valorEmail')";
		if (mysqli_query($conn, $sql)) {
            echo '<script>M.toast({html:"Usuario añadido correctamente.", classes: "rounded"})</script>';
            ?>
			  <script>
			    var a = document.createElement("a");
			      a.href = "../views/lista_usuarios.php"
			      a.click();
			  </script>
			<?php
		}else{
            echo '<script>M.toast({html:"Hubo un error, intentelo mas tarde.", classes: "rounded"})</script>';
            ?>
			  <script>
			    var a = document.createElement("a");
			      a.href = "../views/lista_usuarios.php"
			      a.click();
			  </script>
			<?php
		}
	}
?>