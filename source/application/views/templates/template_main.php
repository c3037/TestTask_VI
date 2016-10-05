<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<title><?php echo $data['page_title']; ?></title>
<link rel="stylesheet" href="/media/css/font-awesome-4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/media/css/maxmertkit.css">
<script src="/media/js/jquery-1.11.3.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.11.4/jquery-ui.min.js"></script>
<link rel="stylesheet" href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.11.4/themes/cupertino/jquery-ui.css">
<script src="/media/js/datepicker-ru.js"></script>
<script src="/media/js/script.js"></script>

</head>
<body>

<div class="-container _fixed_">
<div class="-row _fixed_">
<div class="-col3">
<hr />
<p class="_center_"><a href="/main/index" title="" class="-btn<?php echo ($data['page_title']=="Расписание поездок") ? " -primary-" : ""; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Расписание&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></p>
<p class="_center_"><a href="/main/add" title="" class="-btn<?php echo ($data['page_title']=="Добавить поездку") ? " -primary-" : ""; ?>">Добавить поездку</a></p>
<hr />
<p class="_center_"><a href="/main/regions" title="" class="-btn<?php echo ($data['page_title']=="Список регионов") ? " -primary-" : ""; ?>">Список регионов</a></p>
<p class="_center_"><a href="/main/add_region" title="" class="-btn<?php echo ($data['page_title']=="Добавить регион") ? " -primary-" : ""; ?>">Добавить регион</a></p>
<hr />
<p class="_center_"><a href="/main/couriers" title="" class="-btn<?php echo ($data['page_title']=="Список курьеров") ? " -primary-" : ""; ?>">Список курьеров</a></p>
<p class="_center_"><a href="/main/add_courier" title="" class="-btn<?php echo ($data['page_title']=="Добавить курьера") ? " -primary-" : ""; ?>">Добавить курьера</a></p>
<hr />
</div>
<div class="-col9">
<h1 class="_center_"><?php echo $data['page_title']; ?></h1>
<hr />

<?php echo $content; ?>

</div>
</div>

</div>

</body>
</html>