<h1>Detalle del pedido</h1>

    <?php if(isset($pedido) ):?>
    
    <?php if(isset($_SESSION['admin']) ):?>
    <h3> Cambiar estado del pedido</h3>
    <form action="<?=base_url?>pedido/estado" method="POST">
        <input type="hidden" value="<?=$pedido->id?>" name="pedido_id"/>
        <select name="estado">
            <option value="confirm" <?=$pedido->estadop=="confirm"? 'selected' : ''?>>pendiente</option>
            <option value="preparation"<?=$pedido->estadop=="preparation"? 'selected' : ''?>>En preparación</option>
            <option value="ready"<?=$pedido->estadop=="ready"? 'selected' : ''?>>Preparado para enviar</option>
            <option value="sended"<?=$pedido->estadop=="sended"? 'selected' : ''?>>Enviado</option>
        </select>
        <input type="submit" value="Cambiar estado"/>
    </form>
    <br/>
    <?php endif; ?>


    <h3>Datos de envio: </h3>
    Estado: <?=$pedido->estado?> <br/>
    Ciudad: <?=$pedido->ciudad?><br/>
    Dirección: <?=$pedido->direccion?><br/>
    <br/>
    <h3>Datos del pedido: </h3>
    Estado del envío: <?= Utils::showEstatus($pedido->estadop)?> <br/>
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
                x<?= $producto->unidades ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
   <?php endif; ?>

