<?php
class UserModel extends Model{

    public function __construct()
    {
        $this->table = 'users';
        $this->con = (new Model)->con;
    }

    public function isUserExist($username,$password){
        $query = "SELECT * FROM users WHERE username = ? AND password = ? LIMIT 1";
        $stmt = $this->con->prepare($query);
        $stmt->execute(array($username,$password));
        return $stmt->rowCount() > 0 ? $stmt->fetch(PDO::FETCH_ASSOC) : false;
    }

}