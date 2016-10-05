<?php
class Model_Couriers extends Model
{
    public function get_list()
    {
        $data = array();
        if($this->conn == null) $this->db_connect();

        $rows = $this->conn->query("SELECT * FROM `couriers` ORDER BY `id` ASC")->fetchAll(PDO::FETCH_ASSOC);
        if(count($rows) > 0)
        {
            foreach($rows as $id => $row)
            {
                $data[$id]['id'] = (int) $row['id'];
                $data[$id]['name'] = htmlspecialchars($row['name'], ENT_QUOTES, "UTF-8");
            }
        }

        return $data;
    }
    
    public function get($id)
    {
        $id = (int) $id;
        if($this->conn == null) $this->db_connect();

        $rows = $this->conn->query("SELECT * FROM `couriers` WHERE `id`='$id'")->fetchAll(PDO::FETCH_ASSOC);
        if(count($rows) == 1)
        {
            $data = array();
            $data['id'] = (int) $rows[0]['id'];
            $data['name'] = htmlspecialchars($rows[0]['name'], ENT_QUOTES, "UTF-8");
        }
        else $data = "no_data";

        return $data;
    }
    
    public function add($name)
    {
        $name = (string) $name;
        if($this->conn == null) $this->db_connect();
        
        $stmt = $this->conn->prepare("INSERT INTO `couriers` SET `name`=:name");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        return ($stmt->rowCount() == 1) ? "success" : "Ошибка занесения в БД";
    }
    
    public function delete($id)
    {
        $id = (int) $id;
        if($this->conn == null) $this->db_connect();
        
        $stmt = $this->conn->prepare("DELETE FROM `couriers` WHERE `id`=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return ($stmt->rowCount() == 1) ? "success" : "Ошибка удаления строки из БД";
    }
}