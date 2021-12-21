<?php if(isset($_SESSION['identity'])): ?>
    <h1>Hacer pedido</h1>
    <br>
    <a href="<?=base_url?>car/index">Ver los productos y el precio del pedido</a>
    <h3>Direccion para el envio</h3>    
    <div class="form-container">
        <form action="<?=base_url?>order/add" method="post">
            <label for="direccion">Nombres y apellidos: </label>
            <input type="text" value="<?=$_SESSION['identity']['nombres']?> <?=$_SESSION['identity']['apellidos']?>">
            <label for="ciudad">Destino: </label>
            <select name="ciudad" id="ciudad" required>
                <option value="">Seleccione una ciudad</option>
                <?php if(!empty($cities)): ?>
                    <?php foreach($cities as $city): ?>
                        <option value="<?=$city['id']?>"><?=$city['nombre']?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
            <label for="direccion">Direccion: </label>
            <input type="text" name="direccion" required>
            <button type="submit">Confirmar pedido</button>
        </form>
    </div>
<?php else: ?>
    <h1>Necesitas estar identificado</h1>
    <p>Necesitas estar logueado en la web para realizar tu pedido</p>
<?php endif; ?>