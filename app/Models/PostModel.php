<?php
class PostModel extends Model{
    public function __construct()
    {
        $this->table = 'posts';
        $this->con = (new Model)->con;
    }

    public function getPosts(){
        $stmt = $this->con->prepare("select posts.* , users.fullname as author ,books.image as book_image, books.title as book_title, books.resp_user_id as resp_id from posts,users,books where posts.user_id = users.id and posts.book_id = books.id ORDER BY posts.id DESC");
        return $stmt->execute() ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }
    public function getPostWhere($key,$value){
        $stmt = $this->con->prepare("select posts.* , users.fullname as author ,books.image as book_image, books.title as book_title, books.resp_user_id as resp_id from posts,users,books where posts.user_id = users.id and posts.book_id = books.id and posts.$key = :$key LIMIT 1");
        return $stmt->execute(array($key => $value)) ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }
}