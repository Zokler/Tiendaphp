<h1>Registro</h1> <!-- comprobar si el registro fue exitoso mediante la sesión previamente creada-->
<!-- Si existe $_SESSION['register'] y su contenido es "complete" significa que el registro fue exitoso-->
<?php if( isset($_SESSION['register']) && $_SESSION['register']=="complete"): ?> 
    <strong class = "alert_green"> Registro completado correctamente </strong>
<?php elseif(isset($_SESSION['register']) && $_SESSION['register']=="failed"): ?>
    <!-- De lo contrario indica que fue un registro fallido-->
    <strong class = "alert_red">Registro fallido, ingresa los datos de nuevo</strong>
<?php endif; ?>
     <!-- llama(carpeta helpers/utils.php)deleteSession borra la $_SESSION para tener listo otro
     posible registro e indique si fue exitoso o no-->
<?php Utils::deleteSession('register');
            $redi = '<script type='
                    .'"text/javascript">'
                    .'window.location='
                    .'"'.base_url.'"'.';'
                    . '</script>';
            echo $redi;
?>

  
  <!--    
<form action = "usuario/save" method = "POST">
    <label for = "nombre"> Nombre </label>
    <input type = "text" name="nombre" required />
  
    <label for = "apellidop"> Apellido Paterno </label>
    <input type = "text" name="apellidop" required />
    
    <label for = "apellidom"> Apellido Materno </label>
    <input type = "text" name="apellidom" required />
 
    <label for = "apellidos"> Apellidos </label>
    <input type = "text" name="apellidos" required />
    
    <label for = "email"> Email </label>
    <input type = "text" name="email" required />

    <label for = "password"> Contraseña </label>
    <input type = "password" name="password" required />
    
    <input type ="submit" value="Registrarse"/>
    
</form>
     -->
