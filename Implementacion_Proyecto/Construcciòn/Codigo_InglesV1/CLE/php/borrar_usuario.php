<?php
include('../php/conexion.php');
$valorId = $conn->real_escape_string($_POST["valorId"]);
    
$sql_delete = "DELETE FROM usuarios WHERE id_usuario =$valorId";

if(mysqli_query($conn, $sql_delete)){
    echo '<script>M.toast({html:"Usuario eliminado.", classes: "rounded"})</script>';
    ?>
	<script>    
		var a = document.createElement("a");
		a.href = "../views/lista_usuarios.php";
		a.click();
	</script>
	<?php
}else{
	echo '<script>M.toast({html:"Ocurrio un error.", classes: "rounded"})</script>';
}
?>