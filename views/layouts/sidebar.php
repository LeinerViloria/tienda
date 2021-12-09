<aside id="lateral">
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
            <li><a href="#">Gestionar categorias</a></li>
            <li><a href="#">Gestionar productos</a></li>
            <li><a href="#">Gestionar pedidos</a></li>                        
            <?php endif; ?>
            <?php if(isset($_SESSION['identity'])): ?>
            <li><a href="#">Mis pedidos</a></li>
            <li><a href="<?=base_url?>user/logout">Cerrar session</a></li>
            <?php else: ?>
            <li><a href="<?=base_url?>user/register">Registrarse</a></li>
            <?php endif; ?>
        </ul>
    </div>
</aside>
<!--Contenido Central-->
<div id="central">