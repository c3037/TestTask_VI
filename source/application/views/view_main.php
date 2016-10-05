<form action="" method="post" id="main">
	<fieldset>
		<legend>Диапазон отправления</legend>
        <div class="-row">
            <div class="-col6">
                <label for="start">От (включительно):</label>
                <input type="text" name="start" id="start" value="<?php echo $data['start']; ?>" class="datepicker">
            </div>
            <div class="-col6">
                <label for="finish">До (включительно):</label>
                <input type="text" name="finish" id="finish" value="<?php echo $data['finish']; ?>" class="datepicker">
            </div>
        </div>
        <input type="submit" class="-btn">
	</fieldset>
</form>

<?php if(count($data['trips']) == 0): ?>
<p>Данных не найдено.</p>

<?php else: ?>
<table class="-table _striped_ _horizontal_">
<thead>
<tr>
<th>Дата отправления</th>
<th>Дата возвращения</th>
<th>Курьер</th>
<th>Регион</th>
<th></th>
</tr>

</thead>
<tbody>

<?php foreach($data['trips'] as $trip): ?>
<tr>
<td><?php echo $trip['departure_date']; ?></td>
<td><?php echo $trip['return_date']; ?></td>
<td><?php echo $trip['courier']; ?></td>
<td><?php echo $trip['region']; ?></td>
<td><a href="/main/delete_trip?id=<?php echo $trip['id']; ?>" title="Удалить"><i class="fa fa-remove"></i></a></td>
</tr>

<?php endforeach; ?>

</tbody>
</table>

<?php endif; ?>