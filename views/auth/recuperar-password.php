<h1 class="nombre-pagina">Recuperar Contraseña</h1>

<p class="descripcion-pagina">Coloca tu nueva Contraseña a contnuación</p>

<?php 
    include_once __DIR__ . "/../templates/alertas.php";
?>

<?php if($error) return; ?>
<form class="formulario" method="POST">
    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" placeholder="Tu nuevo Password" name="password">
    </div>

    <input type="submit" value="Guardar nueva Contraseña" class="boton">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crear una</a>
</div>