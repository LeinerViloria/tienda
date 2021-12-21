<?php if (!empty($thisProduct)) : ?>
    <h1><?= $thisProduct['nombre'] ?></h1>

    <div id="detail-product">
        <?php if (!empty($images)) : ?>
            <div class="container div_images">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <?php foreach ($images as $item => $data_imagen) : ?>
                            <li data-target="#myCarousel" data-slide-to="<?= $item ?>" class="<?php echo ($item == 0) ? 'active' : '' ?>"></li>
                        <?php endforeach; ?>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <?php foreach ($images as $item => $data_imagen) : ?>
                            <div class="item <?php echo ($item == 0) ? 'active' : '' ?> item_image">
                                <img src="data:image/*; base64, <?php echo base64_encode($data_imagen['imagen']) ?>" alt="<?= $thisProduct['nombre'] ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        <?php else : ?>
            <img src="<?= base_url ?>assets/img/camiseta.png" alt="" width="300">
        <?php endif; ?>
        <div class="data">
            <p class="price">$<?= number_format($thisProduct['precio'], 0, ',', '.') ?></p>
            <p class="stock"><?= $thisProduct['stock'] ?></p>
            <p class="descripcion"><?= $thisProduct['descripcion'] ?></p>
            <a href="<?=base_url?>car/add&id_producto=<?=$thisProduct['id']?>" class="button">Comprar</a>
        </div>
    </div>
<?php else : ?>
    <h1>El producto no existe</h1>
<?php endif; ?>