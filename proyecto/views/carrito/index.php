<h1>Carrito de la compra</h1>

<?php if(isset($_SESSION['carrito']) && count($_SESSION['carrito'])>= 1) : 
    require_once "config/rutas.php";
    $ip=Ruta::ctrIp();?>

<table>
    <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Unidades</th>
        <th>Eliminar</th>
    </tr>
    <?php foreach($carrito AS $indice =>  $elemento): 
        $producto = $elemento['producto'];
    ?>
    <tr>
        <td>
            <?php if ($producto->imagen != null) : ?>
                <img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" class="img_carrito"/>
            <?php else: ?>
                <img src="<?= base_url ?>assets/img/tenis.png" class="img_carrito"/>
            <?php endif ?>
        </td>
        
        <td>
            <a href="<?=base_url?>/producto/ver&id=<?=$producto->id?>"><?=$producto->nombre?></a>
        </td>
        
        <td>
            <?=$producto->precio?>
        </td>
        <td>
            <?=$elemento['unidades']?>
            <div class="updown-unidades">
                <a href="<?=base_url?>carrito/up&index=<?=$indice?>" class="button">+</a>
                <a href="<?=base_url?>carrito/down&index=<?=$indice?>"class="button">-</a>
            </div>
        </td>
        <td>
            <a href="<?=base_url?>carrito/delete&index=<?=$indice?>" class="button button-carrito button-red">Quitar producto</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</br>

<div class="delete-carrito">
<a href="<?=base_url?>carrito/delete_all" class="button button-delete button-red">Vaciar carrito</a>
</div>

<div class="total-carrito">
    <?php $stats = Utils::statsCarrito();?>
    <h3>Cocoins total: <?=$stats['total']?></h3>

    <?php
    if(isset($_SESSION['identity']) ){
       // echo '<a href="http://'.$ip.'/BANCOCO/index.php?price='.$stats['total'].'" class="button button-pedido">Hacer pedido</a>';
       echo '
       <a href="http://'.$ip.'/ProyDist/proyecto/pedido/hacer" class="button button-pedido">Hacer pedido</a>';
    }
    else{
        echo '
        <a href="#" data-toggle="modal" data-target="#loginModal" class="btn btn-primary">Entra para comprar</a>
    ';
    }
    ?>
</div>

<!--<div class="total-carrito">
    $stats = Utils::statsCarrito();?>
    <h3>Cocoins total: =$stats['total']?></h3>
    <a href="base_url?>pedido/hacer" class="button button-pedido">Hacer pedido</a>
</div>-->
<?php else: ?>
<p>El carrito está vacío, añade los productos que quieras!</p>
<?php endif; ?>