<?php

/**
 * main model
 */
class Model extends Database
{
    protected $table = "employee_details";
    public $errors = array();

    public function where_condition($column1, $column2, $value1, $value2)
    {
        $column1 = addslashes($column1);
        $column2 = addslashes($column2);
        $query = "select * from $this->table where $column1 = :value1 && $column2 = :value2";
        return $this->query($query, [
            'value1' => $value1,
            'value2' => $value2
        ]);
    }

    public function where($column, $value)
    {

        $column = addslashes($column);
        $query = "select * from $this->table where $column = :value";
        return $this->query($query, [
            'value' => $value
        ]);
    }
    
    public function wherebanned($ip)
    {
        $query = "select * from $this->table where ip_address = :ip limit 1";
        return $this->query($query,[
        'ip'=>$ip
        ]);
    }
    
    public function updatebanned($id,$expire)
    {
        $query = "update $this->table set banned = :banned, login_count = 0  
                             where id = :id limit 1";
        return $this->query($query,[
        'id'=>$id,
        'banned'=>$expire,
        ]);
    }
    
    public function updatebannedlogin_count($id)
    {
        $query = "update $this->table banned set login_count = 0 where id = :id limit 1";
        return $this->query($query,[
        'id'=>$id
        ]);
    }
    
    public function findAll()
    {

        $query = "select * from $this->table ";
        return $this->query($query);
    }
    
    public function updatebannedfinal($ip,$banned,$login_count)
    {
         $query = "insert into $this->table (ip_address,login_count,banned) values (:ip_address,:login_count,:banned)";
        return $this->query($query,[
        'ip_address'=>$ip,
        'banned'=>$banned,
        'login_count'=>$login_count,
        ]);
    }
    
    public function updatebannedbanned_table($id)
    {
         $query = "update $this->table set login_count = login_count + 1 
                             where id = :id limit 1";
        return $this->query($query,[
        'id'=>$id
        ]);
    }
    public function insert($data)
    {


        $keys = array_keys($data);
        $columns = implode(',', $keys);
        $values = implode(',:', $keys);

        $query = "insert into $this->table ($columns) values (:$values)";

        return $this->query($query, $data);
    }

    public function update($id, $data)
    {
        $str = "";
        foreach ($data as $key => $value) {
            // code...
            $str .= $key . "=:" . $key . ",";
        }

        $str = trim($str, ",");

        $data['id'] = $id;
        $query = "update $this->table set $str where employee_ID = :id";

        return $this->query($query, $data);
    }

    public function updatenew($id, $data)
    {
        $str = "";
        foreach ($data as $key => $value) {
            // code...
            $str .= $key . "=:" . $key . ",";
        }

        $str = trim($str, ",");

        $data['id'] = $id;
        $query = "update $this->table set $str where invoice_submission = :id";

        return $this->query($query, $data);
    }

    public function update_status($id, $field, $data)
    {
        $str = "";
        foreach ($data as $key => $value) {
            // code...
            $str .= $key . "=:" . $key . ",";
        }

        $str = trim($str, ",");

        $data['id'] = $id;
        $query = "update $this->table set $str where $field = :id";

        return $this->query($query, $data);
    }

    public function update_condition($id1, $field1,$id2,$field2, $data)
    {
        $str = "";
        foreach ($data as $key => $value) {
            // code...
            $str .= $key . "=:" . $key . ",";
        }

        $str = trim($str, ",");

        $data['id1'] = $id1;
        $data['id2'] = $id2;
        $query = "update $this->table set $str where $field1 = :id1 and $field2 = :id2";

        return $this->query($query, $data);
    }

    public function delete($id)
    {
        $query = "delete from $this->table where employee_ID= :id";
        $data['id'] = $id;
        return $this->query($query, $data);

    }
    
     public function deleteper($column,$id)
    {
        $query = "delete from $this->table where $column= :id";
        $data['id'] = $id;
        return $this->query($query,$data);
        
    }
    
    public function deletepsw($id)
    {
        $query = "delete from $this->table where pwdResetEmail= :id";
        $data['id'] = $id;
        return $this->query($query, $data);

    }

}

