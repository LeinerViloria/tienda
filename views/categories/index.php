<h1>Gestionar categorias</h1>

<a href="<?=base_url?>category/create" class="button button-small">
    Crear categoria
</a>

<?php
    if(!empty($all)):
?>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
    </tr>
<?php
        foreach($all as $id => $cat):
?>
<tr>
    <td><?=$id?></td>
    <td><?=$cat?></td>
</tr>    
<?php
        endforeach;
?>
</table>
<?php
    endif;
?>