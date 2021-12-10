<h1>Crear nevos productos</h1>

<div class="form_container">
    <form action="<?= base_url ?>product/save" method="post" enctype="multipart/form-data">
        <label for="id">Id</label>
        <input type="text" name="id" autofocus required>
        <label for="category">Categoria</label>
        <select name="category" id="category" required>
            <option value="">Seleccione la categoria</option>
            <?php if (!empty($categories)) : ?>
                <?php foreach ($categories as $item => $cat) : ?>
                    <option value="<?= $item ?>"><?= $cat ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
        <label for="name">Nombre</label>
        <input type="text" name="nombre" required>
        <label for="price">Precio</label>
        <input type="number" name="price" id="price" required minlength="4" min="0">
        <label for="stock">Stock</label>
        <input type="number" name="stock" id="stock" required minlength="1" min="0">
        <label for="image">Imagen</label>
        <input type="file" name="image[]" id="image" multiple="multiple" accept="image/*">
        <label for="descripcion">Descripcion</label>
        <textarea name="descripcion" id="descripcion" cols="30" rows="10" required></textarea>
        <button type="submit">Guardar</button>
    </form>
</div>