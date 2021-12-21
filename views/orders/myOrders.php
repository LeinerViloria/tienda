<h1><?php echo $gestion ? 'Gestion de productos' : 'Mis pedidos' ?></h1>
<?php if(!empty($pedidos)): ?>

    <table>
        <thead>
            <tr>
                <th>N° Pedido</th>
                <th>Ciudad</th>
                <th>Coste</th>
                <th>Fecha</th>
                <?php if($gestion): ?>
                <th>Estado</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach($pedidos as $pedido): ?>
                <tr>
                    <td><a href="<?=base_url?>order/detail&id=<?=$pedido['id']?>"><?=$pedido['id']?></a></td>
                    <td><?=$pedido['nombre']?></td>
                    <td>$<?=number_format($pedido['coste'], 0, ',', '.')?></td>
                    <td><?=Utils::getMonthName($pedido['fecha'])?></td>
                    <?php if($gestion): ?>
                    <td><?=Utils::showstatus($pedido['estado'])?></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>