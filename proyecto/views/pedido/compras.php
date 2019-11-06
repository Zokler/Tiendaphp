<h1> MIS COMPRAS <h1>       
<table>
    <tr>
        <th>N° pedido</th>
        <th>Coste</th>
        <th>Fecha</th>

    </tr>
    <?php 
        while($com = $compras->fetch_object()):
    ?>
    <tr>
        <td>
            <a href="<?=base_url?>/pedido/detalle&id=<?=$com->id?>"><?=$com->id?></a>
        </td>
        
        <td>
            <?=$com->coste?> cocoins
        </td>
        
        <td>
            <?=$com->fecha?>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

