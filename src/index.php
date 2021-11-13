<?php namespace Core;
require_once "libs/core.php";
__init();

if(empty($_GET['f']))
	header("Location: /login");

$title = ucwords($_GET['f']);
$file = "$_GET[f].php";
if (!file_exists($file))
	$file = "components/_e404.php";

$app = new App();
?>

<html>
	<head>
		<title><?= $title ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="/public/styles.css" />
		<link rel="icon" href="/public/favicon.ico" type="image/x-icon">
		<script src="/public/main.js"></script>
	</head>
	<body>
		<?php require_once $file ?>
	</body>
</html>
