<?php
class BookModel extends Model{

    public $con;

    public function __construct()
    {
        $this->table = 'books';
        $this->con = (new Model)->con;
    }

    public function getBooks(){
        $stmt = $this->con->prepare("select books.* , users.fullname as rep_name , categories.name as cat_name from books,users,categories where books.resp_user_id = users.id and books.category_id = categories.id ORDER BY books.id DESC");
        return $stmt->execute() ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }
    

}