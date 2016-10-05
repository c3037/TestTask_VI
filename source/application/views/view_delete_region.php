<?php if($data['status'] != null): ?>
<div class="-alert -error- -shadow-lifted-"><?php echo $data['status']; ?></div>

<?php endif; ?>

<?php if($data['status'] != 'Данных не найдено'): ?>
<p>Вы действительно хотите удалить регион <?php echo $data['name']; ?>?</p>
<form action="" method="post" id="delete_region">
    
    <input type="hidden" name="yes" value="1">
    <input type="submit" class="-btn" value="Удалить регион">
    
</form>

<?php endif; ?>