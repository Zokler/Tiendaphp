<h1>Gestionar categorias</h1>
<a href="<?=base_url?>categoria/crear" class="button button-small">
    Crear categoria
</a>
<!-- Recorre dentro del objeto todas las categorias que tiene en él-->
<!-- Cada iteracion que se haga es una nueva categoria-->
<table>
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>BORRAR</th>
    </tr>
    <?php while ($cat = $categorias->fetch_object()): ?>
        <tr>
            <td><?= $cat->id; ?></td>
            <td><?= $cat->nombre; ?></td>
            <td>    
                <a href="<?=base_url?>categoria/delete&id=<?=$cat->id?>">borrar</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>


