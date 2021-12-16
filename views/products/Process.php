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
    if(!empty($_SESSION['saveImage'])):
?>
<h2 class="<?php echo $_SESSION['saveImage']=="Imagenes guardadas" ? "class_success" : "class_error" ?>"><?=$_SESSION['saveImage']?></h2>
<?php
    Utils::deleteSession("saveImage");
    endif;
?>

<?php
    if(!empty($_SESSION['productDelete'])):
?>
<h2 class="<?php echo $_SESSION['productDelete']=="Completed" ? "class_success" : "class_error" ?>"><?=$_SESSION['productDelete']?></h2>
<?php
    Utils::deleteSession("productDelete");
    endif;
?>

<?php
    if(!empty($_SESSION['DeleteImage'])):
?>
<?php echo $_SESSION['DeleteImage']=="Completed" ? '<h2 class="class_success">La imagen se borro</h2>' : '<h2 class="class_error">La imagen no se borro</h2>' ?>
<?php
    Utils::deleteSession("DeleteImage");
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
        <th>Acciones</th>
    </tr>
<?php
        foreach($productos as $pro):
?>
<tr>
    <td><?=$pro['id']?></td>
    <td><?=$pro['nombre']?></td>
    <td><?=number_format($pro['precio'], 0, ',', '.')?></td>
    <td><?=$pro['stock']?></td>
    <td>
        <a href="<?=base_url?>product/edit&id=<?=$pro['id']?>" class="button button-gestion">Editar</a>
        <a href="<?=base_url?>product/delete&id=<?=$pro['id']?>" class="button button-gestion button-red">Eliminar</a>
    </td>
</tr>    
<?php
        endforeach;
?>
</table>
<?php
    endif;
?>