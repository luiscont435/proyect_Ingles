<?php
include('../php/conexion.php');
$ValorDe = $conn->real_escape_string($_POST['valorDe']);
$ValorA = $conn->real_escape_string($_POST['valorA']);

$usuarios = mysqli_query($conn, "SELECT * FROM users WHERE area='Redes'");
while($usuario = mysqli_fetch_array($usuarios)){
  $user=$usuario['user_name'];
?>
<br><br>
<h3 class="center">TECNICO: <?php echo $usuario['firstname']; ?></h3>
<h4>Instalaciones</h4>
<table class="bordered highlight responsive-table">
    <thead>
      <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Comunidad</th>
        <th>Fecha</th>
        <th>Técnicos</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $resultado_instalaciones = mysqli_query($conn,"SELECT * FROM clientes WHERE fecha_instalacion>='$ValorDe' AND fecha_instalacion<='$ValorA' AND  tecnico LIKE '%$user%'");
      $aux = mysqli_num_rows($resultado_instalaciones);
      if($aux>0){
      while($instalaciones = mysqli_fetch_array($resultado_instalaciones)){
        $id_comunidad = $instalaciones['lugar'];
        $comunidad = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM comunidades WHERE id_comunidad = '$id_comunidad'"));
        ?>
        <tr>
          <td><b><?php echo $instalaciones['id_cliente'];?></b></td>
          <td><?php echo $instalaciones['nombre'];?></td>
          <td><?php echo $comunidad['nombre'];?></td>
          <td><?php echo $instalaciones['fecha_instalacion'];?></td>
          <td><?php echo $instalaciones['tecnico'];?></td>
        </tr>
      <?php
        $aux--;
      }
      }else{
        echo "<center><b><h5>No se encontraron instalaciones</h5></b></center>";
      }
      ?>       
    </tbody>
</table><br><br>

<?php
$id = $usuario['user_id'];
$sql = mysqli_query($conn, "SELECT * FROM reportes WHERE  fecha>='$ValorDe' AND fecha<='$ValorA'  AND atendido = 1 AND tecnico = '$id'");
?>
<h4>Reportes</h4>
<table class="bordered highlight responsive-table" width="100%">
        <thead>
          <tr>
            <th>Id. Reporte</th>
            <th>Id. Cliente</th>
            <th>Nombre Cliente</th>
            <th>Fecha Solución</th>
            <th width="15%">Descripción</th>
            <th>Técnico</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $aux = mysqli_num_rows($sql);
        if($aux>0){ 
        while ($info = mysqli_fetch_array($sql)) {
          $id_cliente = $info['id_cliente'];
          $cliente = mysqli_fetch_array(mysqli_query($conn, "SELECT nombre FROM clientes WHERE id_cliente=$id_cliente"));
          $id_tecnico=$info['tecnico'];
          if ($id_tecnico == NULL) {
            $tecnico['user_name'] = 'Sin Tecnico';
          }else{
            $tecnico = mysqli_fetch_array(mysqli_query($conn, "SELECT user_name FROM users WHERE user_id=$id_tecnico"));
          }
        ?>
          <tr>
            <td><?php echo $info['id_reporte']; ?></td>
            <td><?php echo $info['id_cliente']; ?></td>
            <td><?php echo $cliente['nombre']; ?></td>            
            <td><?php echo $info['fecha_solucion']; ?></td>
            <td><?php echo $info['descripcion']; ?></td>
            <td><?php echo $tecnico['user_name']; ?></td>
          </tr>
        <?php
        $aux--;
        }
        }else{
          echo "<center><b><h5>No se encontraron reportes</h5></b></center>";
        }
        ?>
        </tbody>        
</table><br><br><br>
<?php
}
mysqli_close($conn);
?>