<html>
	<head>
		<title><?= $_GET['t'] ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link type="text/css" href="/public/styles.css" />
		<link rel="icon" href="/public/favicon.ico" type="image/x-icon">
		<script src="/public/main.js"></script>
	</head>
	<body>
		<?php require_once "$_GET[f].php" ?>
	</body>
</html>
