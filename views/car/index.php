<h1>Carrito de la compra</h1>

<table>
    <thead>
        <tr>            
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
            <th>Total</th>
            <th>Accion</th>
        </tr>
    </thead>
    <tbody>
    <?php if(!empty($carrito)): ?>
        <?php foreach($carrito as $item => $elemento): ?>
            <tr>
                <td><a href="<?=base_url?>product/look_at&id=<?=$elemento['id']?>"><?=$elemento['producto'][0]['nombre']?></a></td>
                <td>$<?=number_format($elemento['precio'], 0, ',', '.')?></td>
                <td>
                    <a href="<?=base_url?>car/down&item=<?=$item?>" class="button-updown">-</a>
                    <?=$elemento['unidades']?>
                    <a href="<?=base_url?>car/up&item=<?=$item?>" class="button-updown">+</a>
                </td>
                <td>$<?=number_format($elemento['precio']*$elemento['unidades'], 0, ',', '.')?></td>
                <td><a href="<?=base_url?>car/remove&id=<?=$item?>" class="button button-red button-remove-car">Remover producto</a></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
<?php if(!empty($carrito)): ?>
    <div class="delete-carrito">
        <a href="<?=base_url?>car/delete_all" class="button button-red button-delete">Vaciar carrito</a>
    </div>
    <div class="total-carrito">
        <h3>Total de la compra: $<?=number_format(Utils::statsCarrito()['total'], 0, ',', '.')?></h3>
        <a href="<?=base_url?>order/make" class="button button-pedido">Hacer pedido</a>        
    </div>
<?php endif; ?>