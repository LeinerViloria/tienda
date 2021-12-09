<h1>Crear nueva categoria</h1>

<form action="<?=base_url?>category/save" method="post">
    <label for="name">Nombre</label>
    <input type="text" name="nombre" autofocus required>
    <button type="submit">Guardar</button>
</form>