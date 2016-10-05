<?php if(count($data['couriers']) == 0): ?>
<p>Данных не найдено.</p>

<?php else: ?>
<table class="-table _striped_ _horizontal_">
<thead>
<tr>
<th>#</th>
<th>Полное имя</th>
<th></th>
</tr>
</thead>
<tbody>

<?php foreach($data['couriers'] as $courier): ?>
<tr>
<td><?php echo $courier['id']; ?></td>
<td><?php echo $courier['name']; ?></td>
<td><a href="/main/delete_courier?id=<?php echo $courier['id']; ?>" title="Удалить"><i class="fa fa-remove"></i></a></td>
</tr>

<?php endforeach; ?>

</tbody>
</table>

<?php endif; ?>