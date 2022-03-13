<h1 class="nombre-pagina">Nuevo Servicio</h1>
<p class="descripcion-pagina">Llena Todos los Campos Para Añadir un Nuevo Servicio</p> 

<?php
    include_once __DIR__ . '/../templates/barra.php';
    include_once __DIR__ . '/../templates/alertas.php';
?>

<form action="/servicios/crear" class="formulario" method="POST">
    <?php include_once __DIR__ . '/formulario.php'; ?>

    <input type="submit" value="Guardar Servicio" class="boton">
</form>