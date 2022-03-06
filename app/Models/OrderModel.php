<?php
class OrderModel extends Model{
    public $con;

    public function __construct()
    {
        $this->table = 'orders';
        $this->con = (new Model)->con;
    }

    public function getOrders(){
        $stmt = $this->con->prepare("select books.title as book_name ,books.image as book_image, orders.* from books,orders where books.id = orders.product_id ORDER BY orders.id DESC");
        return $stmt->execute() ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }

    public function getOrderWhere($key,$value){
        $stmt = $this->con->prepare("select books.title as book_name ,books.image as book_image, orders.* from books,orders where books.id = orders.product_id and orders.id = :$key LIMIT 1");
        return $stmt->execute(array($key => $value)) ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }
    
}