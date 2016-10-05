<?php
class Model_Regions extends Model
{
    public function get_list()
    {
        $data = array();
        if($this->conn == null) $this->db_connect();

        $rows = $this->conn->query("SELECT * FROM `regions` ORDER BY `id` ASC")->fetchAll(PDO::FETCH_ASSOC);
        if(count($rows) > 0)
        {
            foreach($rows as $id => $row)
            {
                $data[$id]['id'] = (int) $row['id'];
                $data[$id]['name'] = htmlspecialchars($row['name'], ENT_QUOTES, "UTF-8");
                $data[$id]['days_in'] = (int) $row['days_in'];
                $data[$id]['days_out'] = (int) $row['days_out'];
            }
        }

        return $data;
    }
    
    public function get($id)
    {
        $id = (int) $id;
        if($this->conn == null) $this->db_connect();

        $rows = $this->conn->query("SELECT * FROM `regions` WHERE `id`='$id'")->fetchAll(PDO::FETCH_ASSOC);
        if(count($rows) == 1)
        {
            $data = array();
            $data['id'] = (int) $rows[0]['id'];
            $data['name'] = htmlspecialchars($rows[0]['name'], ENT_QUOTES, "UTF-8");
            $data['days_in'] = (int) $rows[0]['days_in'];
            $data['days_out'] = (int) $rows[0]['days_out'];
        }
        else $data = "no_data";

        return $data;
    }
    
    public function add($name, $days_in, $days_out)
    {
        $name = (string) $name;
        $days_in = (int) $days_in;
        $days_out = (int) $days_out;
        
        if($days_in <= 0 or $days_out <= 0) return "Неправильное значение одного из полей #Длительность_поездки#";
        
        if($this->conn == null) $this->db_connect();
        $stmt = $this->conn->prepare("INSERT INTO `regions` SET `name`=:name, `days_in`=:days_in, `days_out`=:days_out");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':days_in', $days_in);
        $stmt->bindParam(':days_out', $days_out);
        $stmt->execute();
        return ($stmt->rowCount() == 1) ? "success" : "Ошибка занесения в БД";
    }
    
    public function delete($id)
    {
        $id = (int) $id;

        if($this->conn == null) $this->db_connect();
        $stmt = $this->conn->prepare("DELETE FROM `regions` WHERE `id`=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return ($stmt->rowCount() == 1) ? "success" : "Ошибка удаления строки из БД";
    }
}