<?php
    include("../php/conexion.php");

    $Texto = $conn->real_escape_string($_POST['texto']);
    //Filtro anti-XSS
    $caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/");
    $caracteres_buenos = array("& lt;", "& gt;", "& quot;", "& #x27;", "& #x2F;", "& #060;", "& #062;", "& #039;", "& #047;");

    $Texto = str_replace($caracteres_malos, $caracteres_buenos, $Texto);

    $sql = "SELECT * FROM alumnos";
    if ($Texto != ""){
        $sql = "SELECT * FROM alumnos WHERE no_control = '$Texto' OR Nombre LIKE '%$Texto%' OR Carrera LIKE '%$Texto%'";
    }
    $alumnos = mysqli_query($conn, $sql)
?>
<table class="bordered highlight" id="datos">
    <thead>
        <tr>
            <th>ID</th>
            <th>No. Control</th>
            <th>Nombre</th>
            <th>Carrera</th>
            <th>Pagos</th>
            <th>Editar</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $filas = mysqli_num_rows($alumnos);
    if ($filas == 0) {
    	echo '<script>M.toast({html:"No se encontraron alumnos.", classes: "rounded"})</script>';
    }else{
    while ($alumno = mysqli_fetch_array($alumnos)) {
    ?>
    	<tr>
    		<td><?php echo $alumno['id_alumno']; ?></td>
    		<td><?php echo $alumno['no_control']; ?></td>
    		<td><?php echo $alumno['Nombre']; ?></td>
    		<td><?php echo $alumno['Carrera']; ?></td>
    		<td><form method="post" action="../views/pago_alumno.php"><input name="id_alumno" type="hidden" value="<?php echo $alumno['id_alumno']; ?>"><button type="submit" class="btn-floating btn-tiny waves-effect waves-light indigo"><i class="material-icons">credit_card</i></button></form></td>
            <td><form method="post" action="../views/editar_alumno.php"><input id="no_alumno" name="no_alumno" type="hidden" value="<?php echo $alumno['id_alumno']; ?>"><button class="btn-floating btn-tiny waves-effect waves-light indigo"><i class="material-icons">edit</i></button></form></td>	
    	</tr>
    <?php
	}
	}
    ?>
    </tbody>
</table>
<script>
     
</script>