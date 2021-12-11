<h1>Gestión de productos</h1>

<a href="<?=base_url?>product/create" class="button button-small">
    Crear producto
</a>

<?php
    if(!empty($_SESSION['productSave'])):
?>
<h2 class="<?php echo $_SESSION['productSave']=="Completed" ? "class_success" : "class_error" ?>"><?=$_SESSION['productSave']?></h2>
<?php
    Utils::deleteSession("productSave");
    endif;
?>


<?php
    if(!empty($productos)):
?>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Stock</th>
    </tr>
<?php
        foreach($productos as $pro):
?>
<tr>
    <td><?=$pro['id']?></td>
    <td><?=$pro['nombre']?></td>
    <td><?=number_format($pro['precio'], 0, ',', '.')?></td>
    <td><?=$pro['stock']?></td>
</tr>    
<?php
        endforeach;
?>
</table>
<?php
    endif;
?>