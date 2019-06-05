<!DOCTYPE html>
<html>
<head>
	<title>CLE | Usuarios</title>
<?php
include('Nav.php');
include('../php/conexion.php');
?>
<script>
	function borrar(id_usuario){
		
		$.post("../php/borrar_usuario.php" , { 
	          valorId: id_usuario,
	        }, function(mensaje) {
	            $("#mostrar_usuario").html(mensaje);
	    });
	};
</script>
</head>
<body>
	<div class="container">
		<div id="mostrar_usuario"></div>
		<div class="row">
			<h2>Usuarios:</h2>
		</div>	
		<table class="bordered highlight responsive-table">
			<thead>
				<th>ID</th>
				<th>Nombre</th>
				<th>Usuario</th>
				<th>Email</th>
				<th>Borrar</th>
			</thead>
			<tbody id="resultado_usuarios">
			<?php
			$sql = mysqli_query($conn,"SELECT * FROM usuarios");
	        $filas = mysqli_num_rows($sql);
	        if($filas == 0){
	            ?>
	            <h5 class="center">No hay usuarios</h5>
	            <?php
	        }else{
	           while($usuarios = mysqli_fetch_array($sql)){
			?>
			<tr>
				<td><?php echo $usuarios['id_usuario']; ?></td>
				<td><?php echo $usuarios['Nombre']; ?></td>
				<td><?php echo $usuarios['usuario']; ?></td>
				<td><?php echo $usuarios['email']; ?></td>
				<td><a onclick="borrar(<?php echo $usuarios['id_usuario'];?>);" class="btn btn-floating red darken-1 waves-effect waves-light"><i class="material-icons">delete</i></td>
			</tr>
			<?php
	            }
	        }
	        mysqli_close($conn);
	        ?>
			</tbody>
		</table>
	</div><br>
</body>
</html>