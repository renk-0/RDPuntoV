<?php
$app->load("Productos");
$productos = $app->module->leer();

print_r($productos);
?>

<a href="?s=add_product" class="btn">Agregar producto</a>
