<?php
include('../php/conexion.php');
$valorId = $conn->real_escape_string($_POST["valorId"]);
$id_alumno = $conn->real_escape_string($_POST["id_alumno"]);

$sql_delete = "DELETE FROM pagos WHERE id_pago=$valorId";

if(mysqli_query($conn, $sql_delete)){
    echo '<script>M.toast({html:"Pago eliminado.", classes: "rounded"})</script>';
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
        $sql = mysqli_query($conn, "SELECT * FROM pagos WHERE id_alumno = $id_alumno ORDER BY id_pago DESC");
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
