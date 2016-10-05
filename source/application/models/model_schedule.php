<?php
class Model_Schedule extends Model
{
    public function get_list($start = null, $finish = null)
    {
        $data = array();
        if($this->conn == null) $this->db_connect();
        
        $where = "";
        
        if($start !== null and $start != "")
        {
            $start = (string) $start;
            $start = explode("-", $start);
			if(isset($start[0]) and isset($start[1]) and isset($start[2]))
			{
				$start = (int)$start[2]."-".(int)$start[1]."-".(int)$start[0];
				$where .= "('$start' <= departure_date) ";
			}
            
        }
        
        if($finish !== null and $finish != "")
        {
            $finish = (string) $finish;
            $finish = explode("-", $finish);
			if(isset($finish[0]) and isset($finish[1]) and isset($finish[2]))
			{
				$finish = (int)$finish[2]."-".(int)$finish[1]."-".(int)$finish[0];
				if($where != "") $where .= "AND ";
				$where .= "('$finish' >= departure_date) ";
			}
        }
        
        if($where != "") $where = "WHERE ".$where;
        
        $sql = "
            SELECT
                s.id,
                DATE_FORMAT(s.departure_date,'%d-%m-%Y') as d1,
                DATE_FORMAT(DATE_ADD(s.departure_date, INTERVAL (r.days_in + r.days_out) DAY),'%d-%m-%Y') AS d2,
                c.name as courier,
                r.name as region
            FROM
                `schedule` AS s
            LEFT JOIN regions AS r ON s.region = r.id
            LEFT JOIN couriers AS c ON s.courier = c.id
            $where
            ORDER BY s.departure_date ASC, courier ASC, region ASC;
        ";
        
        $rows = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        if(count($rows) > 0)
        {
            foreach($rows as $id => $row)
            {
                $data[$id]['id'] = (int) $row['id'];
                $data[$id]['departure_date'] = htmlspecialchars($row['d1'], ENT_QUOTES, "UTF-8");
                $data[$id]['return_date'] = htmlspecialchars($row['d2'], ENT_QUOTES, "UTF-8");
                $data[$id]['courier'] = htmlspecialchars($row['courier'], ENT_QUOTES, "UTF-8");
                $data[$id]['region'] = htmlspecialchars($row['region'], ENT_QUOTES, "UTF-8");
            }
        }

        return $data;
    }
    
    public function get($id)
    {
        $id = (int) $id;
        if($this->conn == null) $this->db_connect();

        $rows = $this->conn->query("SELECT * FROM `schedule` WHERE `id`='$id'")->fetchAll(PDO::FETCH_ASSOC);
        if(count($rows) == 1)
        {
            $data = array();
            $data['id'] = (int) $rows[0]['id'];
        }
        else $data = "no_data";

        return $data;
    }
    
    public function add($courier, $region, $departure_date)
    {
        $courier = (int) $courier;
        $region = (int) $region;
        $departure_date = (string) $departure_date;
        $departure_date = explode("-", $departure_date);
        
        if(
            $courier <= 0 or $region <= 0 or 
            !isset($departure_date[0]) or $departure_date[0] <= 0 or 
            !isset($departure_date[1]) or $departure_date[1] <= 0 or 
            !isset($departure_date[2]) or $departure_date[2] <= 0
        )
            return "Неверное значение полей";
        
        $departure_date = $departure_date[2]."-".$departure_date[1]."-".$departure_date[0];
        if($this->conn == null) $this->db_connect();
        
        $sql = "SELECT
                    COUNT(*) as count, name, DATE_FORMAT(return_date,'%d-%m-%Y') as return_date
                FROM
                    (
                        SELECT
                            d1,
                            DATE_ADD(
                                d1,
                                INTERVAL (x.days_in + x.days_out) DAY
                            ) AS d2
                        FROM
                            (SELECT :departure_date AS d1) AS d,
                            regions AS x
                        WHERE
                            x.id = :region
                    ) AS Q,
                    (
                        SELECT
                            s.departure_date,
                            DATE_ADD(
                                s.departure_date,
                                INTERVAL (r.days_in + r.days_out) DAY
                            ) AS return_date,
			                r.name
                        FROM
                            `schedule` AS s
                        LEFT JOIN regions AS r ON s.region = r.id
                        LEFT JOIN couriers AS c ON s.courier = c.id
                        WHERE
                            c.id = :courier
                    ) AS W
                WHERE
                    (
                        d1 >= departure_date
                        AND d1 < return_date
                    )
                OR (
                    d2 > departure_date
                    AND d2 <= return_date
                )
                OR (
                    d1 <= departure_date
                    AND d2 >= return_date
                );
        ";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':courier', $courier);
        $stmt->bindParam(':region', $region);
        $stmt->bindParam(':departure_date', $departure_date);
        $stmt->execute();
        $res = $stmt->fetchObject();
        if($res->count != 0) return "Данный курьер в указанное время находится в поездке.<br>Регион: {$res->name}. Поездка завершится: {$res->return_date}";
        
        $stmt = $this->conn->prepare("INSERT INTO `schedule` SET `courier`=:courier, `region`=:region, `departure_date`=:departure_date");
        $stmt->bindParam(':courier', $courier);
        $stmt->bindParam(':region', $region);
        $stmt->bindParam(':departure_date', $departure_date);
        $stmt->execute();
        
        return ($stmt->rowCount() == 1) ? "success" : "Ошибка занесения в БД";
    }
    
    public function delete($id)
    {
        $id = (int) $id;

        if($this->conn == null) $this->db_connect();
        $stmt = $this->conn->prepare("DELETE FROM `schedule` WHERE `id`=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return ($stmt->rowCount() == 1) ? "success" : "Ошибка удаления строки из БД";
    }
}