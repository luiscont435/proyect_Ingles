<!DOCTYPE html>
<html>
<head>
	<title>CLE | Usuarios</title>
<?php
include ('Nav.php');
?>
<script>
	function insert_usuario(){
		var textoNombre = $("input#nombre").val();
		var textoApellidos = $("input#Apellidos").val();
		var textoPassword = $("input#password").val();
		var textoRepetir = $("input#repetir").val();
		var textoUsuario = $("input#usuario").val();
		var textoEmail = $("input#email").val();

	  if (textoNombre == "") {
        M.toast({html:"Por favor ingrese el nombre(s).", classes: "rounded"});
      }else if(textoApellidos == ""){
        M.toast({html:"Por favor ingrese los apellidos.", classes: "rounded"});
      }else if(textoUsuario == ""){
        M.toast({html:"Por favor ingrese el nombre de usuario.", classes: "rounded"});
      }else if(textoPassword == ""){
        M.toast({html:"Por favor ingrese una contraseña.", classes: "rounded"});
      }else if ((textoPassword.length) < 6) {
        M.toast({html:"Por favor ingrese una contraseña mas larga.", classes: "rounded"});
      }else if(textoPassword != textoRepetir){
        M.toast({html:"Las contraseñas no coinciden.", classes: "rounded"});
      }else if(textoEmail == ""){
        M.toast({html:"Porfavor ingrese un email.", classes: "rounded"});
      }else{
		$.post("../php/insertar_usuario.php", {
            valorNombre: textoNombre+' '+textoApellidos,
            valorEmail: textoEmail,
            valorUsuario: textoUsuario,
            valorPassword: textoPassword,
          }, function(mensaje) {
              $("#resultado_usuarios").html(mensaje);
        }); 
      }
  };
</script>
</head>
<body>
	<div class="container">
		<div id="resultado_usuarios"></div>
		<div class="row">
			<h2>Crear Usuario:</h2>
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
				<i class="material-icons prefix">lock</i>
				<input type="password" name="password" id="password">
				<label for="password">Contraseña</label>
			</div>
			<div class="input-field col s12 m6 l6">
				<i class="material-icons prefix">lock_outline</i>
				<input type="password" name="repetir" id="repetir">
				<label for="repetir">Repetir Contraseña</label>
			</div>
			<div class="input-field col s12 m6 l6">
				<i class="material-icons prefix">mood</i>
				<input type="text" name="usuario" id="usuario">
				<label for="usuario">Usuario</label>
			</div>
			<div class="input-field col s12 m6 l6">
				<i class="material-icons prefix">markunread</i>
				<input type="email" name="email" id="email">
				<label for="email">Correo</label>
			</div>
			<div>
		        <a onclick="insert_usuario();" class="waves-effect waves-light btn indigo right"><i class="material-icons right">send</i>ENVIAR</a>
		    </div>
		</div><br>
	</div>
</body>
</html>