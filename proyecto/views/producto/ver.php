<?php if(isset($product)) : ?>
    <h1><?=$product->nombre?></h1>
    <div id="detail-product">
        <div class="image">
            <?php if ($product->imagen != null) : ?>
                <img src="<?= base_url ?>uploads/images/<?= $product->imagen ?>"/>
            <?php else: ?>
                <img src="<?= base_url ?>assets/img/tenis.png"/>
            <?php endif ?>
        </div>
        <div class="data">
            <h5>Descripción:</h5>
            <p class="description"><?= $product->descripcion ?></p>
            <h5>Precio:</h5>
            <p class="price"><?= $product->precio ?> cocoins</p>
            <h5>Stock:</h5>
            <p class="price"><?= $product->stock ?> Piezas </p>
            
            <a href="<?=base_url?>carrito/add&id=<?=$product->id?>" class = "button">Agregar al carrito</a>
        </div>
    </div>
<?php else: ?>
    <h1>El producto no existe</h1>
<?php endif; ?>