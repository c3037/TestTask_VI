<?php if($data['status'] != null): ?>
<div class="-alert -error- -shadow-lifted-"><?php echo $data['status']; ?></div>

<?php endif; ?>

<?php if($data['status'] != 'Данных не найдено'): ?>
<p>Вы действительно хотите удалить поездку #<?php echo $data['id']; ?>?</p>
<form action="" method="post" id="delete_trip">
    
    <input type="hidden" name="yes" value="1">
    <input type="submit" class="-btn" value="Удалить поездку">
    
</form>

<?php endif; ?>