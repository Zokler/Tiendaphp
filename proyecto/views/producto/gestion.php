<h1>Gestionar producto</h1>
<a href="<?=base_url?>producto/crear" class="button button-small">
    Añadir productos
</a>
<!-- Recorre dentro del objeto todas las categorias que tiene en él-->
<!-- Cada iteracion que se haga es una nueva categoria-->
<?php if(isset($_SESSION['producto']) && $_SESSION['producto']=="complete"):?>
    <strong class="alert_green"> El producto se ha creado correctamente</strong>
<?php elseif(isset($_SESSION['producto']) && $_SESSION['producto'] != "complete"):?>
    <strong class="alert_red"> El registro de producto falló </strong>
<?php endif; ?>
<?php Utils::deleteSession('producto'); ?>

 <?php if(isset($_SESSION['delete']) && $_SESSION['delete']=="complete"):?>
    <strong class="alert_green"> El producto se ha borrado correctamente</strong>
<?php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] != "complete"):?>
    <strong class="alert_green"> El producto se ha borrado correctamente</strong>
<?php endif; ?>
<?php Utils::deleteSession('delete'); ?>
    
<table>
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>PRECIO</th>
        <th>STOCK</th>
        <th>BORRAR</th>
    </tr>
    <?php while ($pro = $productos->fetch_object()): ?>
        <tr>
            <td><?= $pro->id; ?></td>
            <td><?= $pro->nombre; ?></td>
            <td><?= $pro->precio; ?></td>
            <td><?= $pro->stock; ?></td>
            <td>    
                <a href="<?=base_url?>producto/delete&id=<?=$pro->id?>" class="button">borrar</a>
                <a href="<?=base_url?>producto/editar&id=<?=$pro->id?>" class="button">editar</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
