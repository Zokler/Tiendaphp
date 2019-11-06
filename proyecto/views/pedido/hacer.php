<?php if(isset($_SESSION['identity'])) : ?>
    <h1>Hacer pedido</h1>
    <p>
    <a href="<?=base_url?>carrito/index"> Ver productos y precio del pedido</a>
    </p>
    <br/>
    <?php /*foreach($carrito AS $indice =>  $elemento): 
        $producto = $elemento['producto'];
        var_dump($producto);
    endforeach;*/
    ?>
    <h3>Domicilio para envío:</h3>
    <form action="<?=base_url?>pedido/add" method ="POST">
        <label for="estado"> Estado (provincia)</label>
        <input type="text" name="estado" required/>

        <label for="ciudad">Ciudad</label>
        <input type="text" name="ciudad" required/>

        <label for="direccion"> Dirección</label>
        <input type="text" name="direccion" required/>

        <input type="submit" value="Confirmar pedido" onclick="return confirm('¿Está seguro de su compra?')"/>
        
    </form>  
    
<?php else: ?>
    <h1>Necesitas estar identificado!</h1>
    <p> Necesitas estar logeado para realizar tu pedido</p>
<?php endif; ?>
