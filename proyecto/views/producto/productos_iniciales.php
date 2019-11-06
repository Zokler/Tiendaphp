<h1>Algunos de nuestros productos!</h1>

<?php while($product = $productos->fetch_object()): ?>
    <?php if($product->stock != 0) :?>
        <div class="product">
            <a href="<?=base_url?>producto/ver&id=<?=$product->id?>">
                <?php if ($product->imagen != null) : ?>
                    <img src="<?= base_url ?>uploads/images/<?= $product->imagen ?>"/>
                <?php else: ?>
                    <img src="<?= base_url ?>assets/img/tenis.png"/>
                <?php endif ?>
                <h2><?= $product->nombre ?></h2>
            </a>
            <p><?=$product->precio?> cocoins</p>
            <a href="<?=base_url?>carrito/add&id=<?=$product->id?>" class = "button">Agregar al carrito</a>
        </div>
    <?php endif; ?>
<?php endwhile ?>