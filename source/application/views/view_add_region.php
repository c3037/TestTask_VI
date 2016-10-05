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

<form action="" method="post" id="add_region">
    
    <label for="name">Наименование:</label>
    <input type="text" name="name" id="name">
    
    <label for="days_in">Длительность поездки (туда):</label>
    <input type="text" name="days_in" id="days_in">
    
    <label for="days_out">Длительность поездки (обратно):</label>
    <input type="text" name="days_out" id="days_out">
    
    <br><br>
    <input type="submit" class="-btn">
</form>