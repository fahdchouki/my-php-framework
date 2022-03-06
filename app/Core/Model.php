<?php
class Model{

    protected $con;
    protected $table;

    public function __construct()
    {
        $con = new DB;
        $this->con = $con->connect();
    }

    public function table($table){
        $this->table = $table;
        return $this;
    }

    public function getAll($column = "*" , $orderBy = null , $sort = "desc"){

        $query = "SELECT " . $column . " FROM " . $this->table;
        if($orderBy !== null){
            $query = "SELECT " . $column . " FROM " . $this->table . " ORDER BY " . $orderBy . " " . $sort ;
        }
        $stmt = $this->con->prepare($query);
        $stmt->execute();
        return $stmt->rowCount() > 0 ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];

    }

    public function getWhere($key, $value , $orderBy = null , $sort = "desc",$op='='){
        $query = "SELECT * FROM " . $this->table . " WHERE " . $key . " " . $op . " ? ";
        if($orderBy !== null){
            $query = "SELECT * FROM " . $this->table . " WHERE " . $key . " " . $op . " ? ORDER BY " . $orderBy . " " . $sort;
        }
        if($value == null){
            $query = "SELECT * FROM " . $this->table . " WHERE " . $key . " IS NULL";
            $stmt = $this->con->prepare($query);
            $stmt->execute();
            return $stmt->rowCount() > 0 ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
        }
        $stmt = $this->con->prepare($query);
        $stmt->execute(array($value));
        return $stmt->rowCount() > 0 ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }

    public function insert($data){
        $keys = trim(implode(", ",array_keys($data)),", ");
        $values = ":" . trim(implode(", :",array_keys($data)),", :");
        $query = "INSERT INTO " . $this->table . " (" . $keys . ") VALUES (" . $values . ")";
        $stmt = $this->con->prepare($query);
        return $stmt->execute($data) ? true : false;
    }

    public function update($data,$key,$value){
        $keys = explode('?',trim(implode(" = ? , ",array_keys($data)),",") . " = ?");
        $ks = '';
        for($i=0;$i < count($keys) - 1;$i++){
            $ks .= $keys[$i] . ":" . array_keys($data)[$i];
        }
        $stmt = $this->con->prepare("UPDATE ". $this->table ." SET " . $ks . " WHERE " . $key . " = " . $value);
        return $stmt->execute($data) ? true : false;
    }

    public function delete($key,$value){
        $stmt = $this->con->prepare("DELETE FROM " . $this->table . " WHERE " . $key . " = ?");
        return $stmt->execute(array($value)) ? true : false;
    }

    public function is_unique($key,$value){
        $stmt = $this->con->prepare("SELECT * FROM " . $this->table . " WHERE " . $key . " = ? LIMIT 1");
        $stmt->execute(array($value));
        return $stmt->rowCount() > 0 ? false : true;
    }

    public function is_unique_except($key,$value,$exceptionValue){
        $stmt = $this->con->prepare("SELECT * FROM " . $this->table . " WHERE " . $key . " = ? AND ". $key ." != ? LIMIT 1");
        $stmt->execute(array($value,$exceptionValue));
        return $stmt->rowCount() > 0 ? false : true;
    }
}