<?php

// запрет кэширования
header("Pragma: no-cache");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")."GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Expires: " . date("r"));

// подключаем файлы ядра
require_once('core/model.php');
require_once('core/view.php');
require_once('core/controller.php');

// запускаем маршрутизатор
require_once('core/route.php');
Route::start();
