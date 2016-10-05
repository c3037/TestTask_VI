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

<form action="" method="post" id="add">
    
    <label for="courier">Выберите курьера:</label>
    <select name="courier" id="courier">
        <option selected value="-1">---</option>
        <?php if(count($data["couriers"]) > 0): foreach($data["couriers"] as $courier): ?>
        <option value="<?php echo $courier["id"]; ?>"><?php echo $courier["name"]; ?></option>
        <?php endforeach; endif; ?>
    </select>
    
    <label for="region">Выберите регион поездки:</label>
    <select name="region" id="region">
        <option selected value="-1">---</option>
        <?php if(count($data["regions"]) > 0): foreach($data["regions"] as $region): ?>
        <option value="<?php echo $region["id"]; ?>" data-days-in="<?php echo $region["days_in"]; ?>" data-days-out="<?php echo $region["days_out"]; ?>"><?php echo $region["name"]; ?></option>
        <?php endforeach; endif; ?>
    </select>
    
    <label for="date">Укажите дату выезда из Москвы:</label>
    <input type="text" name="date" id="datepicker" style="cursor:pointer;">
    
    <label for="arrival">Дата прибытия в регион:</label>
    <input type="text" name="arrival" id="arrival" disabled="">
    
    <br><br><input type="submit" class="-btn">
    
</form>