<!DOCTYPE html>
<html>
<head>
	<title>CLE | Almunos</title>
<?php
include("Nav.php");
?>
<script>
  function buscar() {
      var texto = $("input#busqueda").val();
      $.post("../php/buscar_alumno.php", {
              texto: texto,
            }, function(mensaje) {
                $("#datos").html(mensaje);
            }); 
    };
</script>
</head>
<body onload="buscar();">
	<div class="container">
    <div class="row">
      <br><br>
      <h3 class="hide-on-med-and-down col s12 m5 l5">Alumnos:</h3>
          <h5 class="hide-on-large-only col s12 m5 l5">Alumnos:</h5>

          <form class="col s12 m7 l7">
          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix">search</i>
              <input id="busqueda" name="busqueda" type="text" class="validate" onkeyup="buscar();">
              <label for="busqueda">Buscar(No.Control, Nombre, Carrera)</label>
            </div>
          </div>
        </form>
    </div>
   <div class="row" id="datos">   
   </div> 
	</div>
</body>
</html>