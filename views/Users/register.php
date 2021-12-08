<h1>Registrarse</h1>
<?php
    if(!empty($_SESSION['register'])):
?>
<h2 class="<?php echo $_SESSION['register']=="Completed" ? "class_success" : "class_error" ?>"><?=$_SESSION['register']?></h2>
<?php
    Utils::deleteSession("register");
    endif;
?>

<form action="<?=base_url?>user/save" method="post" enctype="multipart/form-data">
    <label for="id">Identificacion: </label>
    <input type="text" name="id" id="id" autofocus required>

    <label for="nombres">Nombres: </label>
    <input type="text" name="nombres" id="nombres" required>

    <label for="apellidos">Apellidos: </label>
    <input type="text" name="apellidos" id="apellidos" required>

    <label for="email">Email: </label>
    <input type="email" name="email" id="email" required>

    <label for="password">Contraseña: </label>
    <input type="password" name="password" id="password" minlength="6" maxlength="14" required>

    <label for="num">Numero: </label>
    <input type="text" name="numero" id="num">
    
    <br>
    <input type="file" name="image" id="image" accept="image/*">

    <button type="submit">Registrarse</button>


</form>