<h1> Crear nueva categoria </h1>
<!-- formulario para crear categoria nueva en la BD -->
<form action="<?=base_url?>categoria/save" method="POST">

    <label for="nombre"> Nombre </label>
    <input type="text" name = "nombre" required/>
    
    <input type ="submit" value = "guardar"/>
</form>