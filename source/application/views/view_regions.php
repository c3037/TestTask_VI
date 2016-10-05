<?php if(count($data['regions']) == 0): ?>
<p>Данных не найдено.</p>

<?php else: ?>
<table class="-table _striped_ _horizontal_">
<thead>
<tr>
<th rowspan="2" style="vertical-align:middle;">#</th>
<th rowspan="2" style="vertical-align:middle;">Наименование</th>
<th colspan="2">Длительность поездки, дней</th>
<th rowspan="2"></th>
</tr>
<tr>
<th>(туда)</th>
<th>(обратно)</th>
</tr>
</thead>
<tbody>

<?php foreach($data['regions'] as $region): ?>
<tr>
<td><?php echo $region['id']; ?></td>
<td><?php echo $region['name']; ?></td>
<td><?php echo $region['days_in']; ?></td>
<td><?php echo $region['days_out']; ?></td>
<td><a href="/main/delete_region?id=<?php echo $region['id']; ?>" title="Удалить"><i class="fa fa-remove"></i></a></td>
</tr>

<?php endforeach; ?>

</tbody>
</table>

<?php endif; ?>