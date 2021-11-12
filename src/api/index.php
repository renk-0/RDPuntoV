<?php
require_once "common.php";
Common\__init(true);

$app = new Common\App();
$app->load_module($_GET['m']);
$app->module->perform($_GET['fn'] ?? "");
