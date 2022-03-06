<?php
class CategoryModel extends Model{

    public function __construct()
    {
        $this->table = 'categories';
        $this->con = (new Model)->con;
    }

}