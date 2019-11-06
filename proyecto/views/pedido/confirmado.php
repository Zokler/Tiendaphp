<?php if(isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete') :?>
    <h1>Tu pedido se ha confirmado</h1>
    <p>Tu pedido ha sido guardado con éxito!
    </p>
    
    <br/>
    <?php if(isset($pedido) ):?>
    <h3>Datos del pedido: </h3>
    
    Numero de pedido: <?=$pedido->id?> <br/>
    Total a pagar: <?=$pedido->coste?> cocoins<br/>
    Productos:
    <table>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
        </tr>
        <?php while($producto = $productos->fetch_object()):?>
        <tr>
            <td>
                <?php if ($producto->imagen != null) : ?>
                    <img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" class="img_carrito"/>
                <?php else: ?>
                    <img src="<?= base_url ?>assets/img/tenis.png" class="img_carrito"/>
                <?php endif ?>
            </td>

            <td>
                <a href="<?= base_url ?>/producto/ver&id=<?= $producto->id ?>"><?= $producto->nombre ?></a>
            </td>
            <td>
                <?= $producto->precio ?>
            </td>
            <td>
                <?= $producto->unidades ?>
            </td>
        </tr>
        <?php
            require_once 'models/producto.php';
            $pro = new Producto();
            $pro->setID($producto->id);
            $pro->compra($producto->unidades);
        ?>
        <div class="delete-carrito">
        <a href="<?=base_url?>carrito/delete_all" class="button button-delete button-blue">Continuar</a>
        </div>

        <?php endwhile; ?>
    </table>
   <?php endif; ?>
   <?php
    $ip=Ruta::ctrIp();
    $stats = Utils::statsCarrito();
    echo '
    <a href="http://'.$ip.'/BANCOCO/index.php?price='.$stats['total'].'" class="button button-pedido">Hacer pago</a>
    ';
    ?>
<?php elseif($isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'failed') :?>
    <h1>Tu pedido no se ha confirmado</h1>
    <h4>Puedes intentarlo mas tarde</h4>
<?php endif; ?>
