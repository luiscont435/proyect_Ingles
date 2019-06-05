<!DOCTYPE html>
<html>
<head>
	<title>CLE | Pagos</title>
<?php 
include ('../php/conexion.php');
include ('Nav.php');
$id_alumno = $_POST['id_alumno'];
$alumno = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM alumnos WHERE id_alumno = '$id_alumno'"));
?>
<script>
	function imprimir(id_pago){
	  var a = document.createElement("a");
	      a.target = "_blank";
	      a.href = "../php/imprimir.php?IdPago="+id_pago;
	      a.click();
	}
	function borrar(id_pago){
		$.post("../php/borrar_pago.php" , { 
	          valorId: id_pago,
	          id_alumno: <?php echo $id_alumno; ?>
	        }, function(mensaje) {
	            $("#mostrar_pagos").html(mensaje);
	    });
	};
	function insert_pago(){
		textoIdAlumno = <?php echo $id_alumno; ?>;
		var textoCantidad = $("input#cantidad").val();
		var textoGrado = $("select#grado").val();
		var textoTipo = $("select#tipo").val();

		if (textoCantidad == "" || textoCantidad ==0) {
			M.toast({html: 'El campo Cantidad se encuentra vacío o en 0.', classes: 'rounded'});
		}else if (textoGrado == 0) {
			M.toast({html: 'Seleccione un Grado.', classes: 'rounded'});
		}else if (textoTipo ==0) {
			M.toast({html: 'Seleccione un Tipo.', classes: 'rounded'});
		}else{
			$.post("../php/crear_pago.php" , { 
	          valorCantidad: textoCantidad,
	          valorGrado: textoGrado,
	          valorIdAlumno: textoIdAlumno,
	          valorTipo: textoTipo
	        }, function(mensaje) {
	            $("#mostrar_pagos").html(mensaje);
	        });
		}
	};
</script>
</head>
<body>
  <div class="container">
	<h3 class="hide-on-med-and-down">Pagos</h3>
    <h5 class="hide-on-large-only">Pagos</h5>
  	<div class="row">
  	  <div class="col s12 m1 l1"><br></div>
	  <ul class="collection col s12 m9 l9">
	    <li class="collection-item avatar">
	      <img src="../img/cliente.png" alt="" class="circle">
	      <span class="title"><b>No. Control: </b><?php echo $alumno['no_control'];?></span>
	      <p><b>Nombre: </b><?php  echo $alumno['Nombre'];?><br>
	        <b>Carrera: </b><?php echo $alumno['Carrera'];?><br>
	      </p>
	    </li>
	  </ul>
	</div>
	<div class="row">
	  <div class="row col s12 m4 l4">
        <div class="input-field">
          <i class="material-icons prefix">payment</i>
          <input id="cantidad" type="number" class="validate" data-length="6" required>
          <label for="cantidad">Cantidad:</label>
        </div>
      </div>
      <div class="row col s12 m3 l3"><br>
        <select id="grado" class="browser-default">
          <option value="0" selected>Grado: </option>
          <option value="1">1ro.</option>
          <option value="2">2do.</option>
          <option value="3">3ro.</option>
          <option value="4">4to.</option>
          <option value="5">5to.</option>
          <option value="6">6to.</option>
          <option value="7">7mo.</option>
          <option value="8">8vo.</option>                 
        </select>
      </div>
      <div class="row col s12 m4 l4"><br>
        <select id="tipo" class="browser-default">
          <option value="0" selected>Tipo: </option>
          <option value="1">Libro</option>                 
          <option value="2">Curso</option>                 
        </select>
      </div>
      <a onclick="insert_pago();" class="waves-effect waves-light btn indigo right"><i class="material-icons right">send</i>Registrar Pago</a>
	</div>
	<h4>Historial</h4>
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
            <th>Imprimir</th>
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
	  	  	<td><a onclick="imprimir(<?php echo $pagos['id_pago'];?>);" class="btn btn-floating indigo waves-effect waves-light"><i class="material-icons">print</i></a>
        </td>
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
  </div>
</body>
</html>