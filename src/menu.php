<?php
$selection = $_GET['s'] ?? "";
$file = "components/$selection.php";
?>

<nav>Punto de venta</nav>

<aside>
	<a href="?s=productos">Productos</a>
	<a href="?s=categorias">Categorias</a>
	<a href="?s=transacciones">Transacciones</a>
	<a href="?s=ventas">Ventas</a>
	<a href="?s=carrito">Carrito</a>
</aside>

<main id="main">
<?php 
if(file_exists($file))
	require_once $file;
?>
</main>


