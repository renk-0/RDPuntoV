<?php
if(empty($_GET['f']))
	header("Location: /login");

$title = ucwords($_GET['f']);
$file = "$_GET[f].php";
if (!file_exists($file))
	$file = "_e404.php";

?>

<html>
	<head>
		<title><?= $title ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link type="text/css" href="public/styles.css" />
		<script src="public/main.js"></script>
	</head>
	<body>
		<?php require_once $file ?>
	</body>
</html>
