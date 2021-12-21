<h1>Detalle del pedido</h1>
<?php if (!empty($order)) : ?>
        <?php if(isset($_SESSION['admin'])): ?>
        <h3>Cambiar estado</h3>
        <form action="<?=base_url?>order/status" method="post">
            <input type="hidden" name="orderId" value="<?=$order['id']?>" required>
            <select name="estado" id="estado">
                <option value="confirmado" <?php echo strtolower($order['estado'])=='confirmado' ? 'selected' : '' ?>>Pendiente</option>
                <option value="preparation" <?php echo strtolower($order['estado'])=='preparation' ? 'selected' : '' ?>>En preparacion</option>
                <option value="ready_to_send" <?php echo strtolower($order['estado'])=='ready_to_send' ? 'selected' : '' ?>>Preparado para enviar</option>
                <option value="sent" <?php echo strtolower($order['estado'])=='sent' ? 'selected' : '' ?>>Enviado</option>
            </select>
            <button type="submit">Cambiar estado</button>
        </form>        
        <?php endif; ?>

        <h3>Direccion de envio</h3>
        <ul>
            <li>Ciudad: <?= $order['nombre'] ?></li>
            <li>Direccion: <?= $order['direccion'] ?></li>
        </ul>
        <h3>Datos del pedido</h3>
        <ul>
            <li>Numero del pedido: <?= $order['id'] ?></li>            
            <li>Fecha y hora del pedido: <?= $order['fecha'] ?> <strong>||</strong> <?= Utils::convertedAmPm($order['hora']) ?></li>
            <li>Estado: <strong><?= Utils::showstatus($order['estado']) ?></strong></li>
            <li>Total a pagar: $<?= number_format($order['coste'], 0, ',', '.') ?></li>
            <br>
            <li>
                Productos:

                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Unidades</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $producto) : ?>
                            <tr>
                                <td><?= $producto['nombre'] ?></td>
                                <td>$<?= number_format($producto['precio'], 0, ',', '.') ?></td>
                                <td>x<?= $producto['unidades'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </li>
        </ul>

    <?php endif; ?>