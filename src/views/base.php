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
		<link type="text/css" href="/public/styles.css" />
		<link rel="icon" href="/public/favicon.ico" type="image/x-icon">
		<script src="/public/main.js"></script>
	</head>
	<body>
<<<<<<< HEAD
		<?php require_once "$_GET[f].php" ?>
=======
		<?php require_once $file ?>
>>>>>>> 468f93e19ab0ae12c32e92a979e55b113d2bd94e
	</body>
</html>
