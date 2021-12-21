<aside id="lateral">
    <div id="carrito" class="block_aside">
        <h3>Mi carrito</h3>
        <?php
            $stats = Utils::statsCarrito();
        ?>
        <ul>
            <li><a href="<?=base_url?>car/index">Productos (<?=$stats['count']?>)</a></li>
            <li><a href="<?=base_url?>car/index">Total: $<?=number_format($stats['total'], 0, ',', '.')?></a></li>
            <li><a href="<?=base_url?>car/index">Ver carrito</a></li>            
        </ul>
    </div>

    <div id="login" class="block_aside">
        <?php if(!isset($_SESSION['identity'])): ?>
        <h3>Entrar a la web</h3>
        <form action="<?=base_url?>user/login" method="post">
            <label for="email">Email: </label>
            <input type="email" name="email" required>
            <label for="password">Password: </label>
            <input type="password" name="password" required>
            <button type="submit">Entrar</button>
        </form>
        <?php else: ?>
            <h3><?=$_SESSION['identity']['nombres']?> <?=$_SESSION['identity']['apellidos']?></h3>
        <?php endif; ?>
        <ul>            
            <?php if(isset($_SESSION['admin'])): ?>
            <li><a href="<?=base_url?>category/index">Gestionar categorias</a></li>
            <li><a href="<?=base_url?>product/process">Gestionar productos</a></li>
            <li><a href="<?=base_url?>order/gestion">Gestionar pedidos</a></li>                        
            <?php endif; ?>
            <?php if(isset($_SESSION['identity'])): ?>
            <li><a href="<?=base_url?>order/myOrders">Mis pedidos</a></li>
            <li><a href="<?=base_url?>user/logout">Cerrar session</a></li>
            <?php else: ?>
            <li><a href="<?=base_url?>user/register">Registrarse</a></li>
            <?php endif; ?>
        </ul>
    </div>
</aside>
<!--Contenido Central-->
<div id="central">