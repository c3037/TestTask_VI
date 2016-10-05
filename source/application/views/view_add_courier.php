<?php if($data['status'] == null): ?>
<div class="-alert -primary- -shadow-lifted-" style="display:none"></div>

<?php elseif($data['status'] == 'success'): ?>
<div class="-alert -primary- -shadow-lifted-">
    Операция выполнена успешно.
</div>

<?php else: ?>
<div class="-alert -error- -shadow-lifted-">
   <?php echo $data['status']; ?>
</div>
<?php endif; ?>

<form action="" method="post" id="add_courier">
    
    <label for="name">Полное имя:</label>
    <input type="text" name="name" id="name">
    
    <br><br>
    <input type="submit" class="-btn">
</form>