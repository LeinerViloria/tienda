<h1><?php echo !empty($this_category) ? $this_category[$id] : 'La categoria no existe' ?></h1>

<?php if (!empty($productos) && !empty($this_category)) : ?>
    <?php foreach ($productos as $producto) : ?>
        <div class="product">
            <a href="<?= base_url ?>product/look_at&id=<?= $producto['id'] ?>">
                <?php if (!empty($imagen_productos[$producto['id']])) : ?>
                    <img src="data:image/*; base64, <?php echo base64_encode($imagen_productos[$producto['id']]['imagen']) ?>" alt="<?= $producto['nombre'] ?>" height="110">
                <?php else : ?>
                    <img src="<?= base_url ?>assets/img/camiseta.png" alt="" height="110">
                <?php endif; ?>
                <h2><?= $producto['nombre'] ?></h2>
            </a>
            <p>$<?= number_format($producto['precio'], 0, ',', '.') ?></p>
            <a href="#" class="button">Comprar</a>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <h2>No hay productos</h2>
<?php endif; ?>