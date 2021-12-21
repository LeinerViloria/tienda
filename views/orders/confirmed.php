<?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] == "Completed") : ?>

    <h1>Tu pedido se ha confirmado</h1>
    <p>
        Tu pedido ha sido guardado con exito, una vez hagas la
        transferencia, tu pedido será procesado y enviado.
    </p>

    <?php if (!empty($order)) : ?>
        <h3>Datos del pedido</h3>
        <ul>
            <li>Numero del pedido: <?= $order['Id'] ?></li>
            <li>Fecha y hora del pedido: <?= $order['Fecha'] ?> <strong>||</strong> <?= Utils::convertedAmPm($order['Hora']) ?></li>
            <li>Total a pagar: $<?= number_format($order['Coste'], 0, ',', '.') ?></li>
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
                        <?php foreach ($productos as $producto) : ?>
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

    <?php Utils::deleteSession('pedido'); endif; ?>

<?php elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] == "Failed") : ?>

    <h1>Tu pedido <strong>no</strong> se pudo confirmar</h1>

<?php Utils::deleteSession('pedido'); else :
    header("Location:" . base_url);
endif; ?>