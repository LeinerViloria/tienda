<h1><?php echo ($edit) ? 'Editar producto \'' . $thisProduct['nombre'] . '\'' : 'Crear nuevo producto' ?></h1>

<?php
$url_action = base_url . 'product/save';
//<img id="img" src="data:image/*; base64, <?php echo base64_encode($producto['imagen'])>" alt="<?=$producto['Nombre del producto']>"  >						
?>

<div class="form_container">
    <form action="<?= $url_action ?>" method="post" enctype="multipart/form-data">
        <label for="id">Id</label>
        <input type="text" name="id" value="<?php echo ($edit) ? $thisProduct['id'] : '' ?>" <?php echo ($edit) ? 'readonly' : 'autofocus' ?>  required>
        <label for="category">Categoria</label>
        <select name="category" id="category" required>
            <option value="">Seleccione la categoria</option>
            <?php if (!empty($categories)) : ?>
                <?php foreach ($categories as $item => $cat) : ?>
                    <option value="<?= $item ?>" <?php echo ($edit) && $item == $thisProduct['categoria_id'] ? 'selected' : '' ?>><?= $cat ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
        <label for="name">Nombre</label>
        <input type="text" name="nombre" value="<?php echo ($edit) ? $thisProduct['nombre'] : '' ?>"  <?php echo ($edit) ? 'autofocus' : '' ?> required>
        <label for="price">Precio</label>
        <input type="number" name="price" id="price" value="<?php echo ($edit) ? $thisProduct['precio'] : '' ?>" required minlength="4" min="0">
        <label for="stock">Stock</label>
        <input type="number" name="stock" id="stock" value="<?php echo ($edit) ? $thisProduct['stock'] : '' ?>" required minlength="1" min="0">
        <?php if ($edit && !empty($images)) : ?>
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
                                <div class="carousel-caption">
                                    <button onclick="location.href = '<?= base_url ?>product/deleteImage&id=<?= $data_imagen['id'] ?>'">Borrar imagen</button>
                                </div>
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
        <?php endif; ?>
        <label for="image">Imagen</label>
        <input type="file" name="image[]" id="image" multiple="multiple" accept="image/*">
        <label for="descripcion">Descripcion</label>
        <textarea name="descripcion" id="descripcion" cols="30" rows="10" required><?php echo ($edit) ? $thisProduct['descripcion'] : '' ?></textarea>
        <button type="submit">Guardar</button>
    </form>
</div>