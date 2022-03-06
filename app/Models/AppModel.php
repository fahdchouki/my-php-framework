<?php
class AppModel extends Model{
    public $con;

    public function __construct()
    {
        $this->table = 'apps';
        $this->con = (new Model)->con;
    }

    public function getApps(){
        $stmt = $this->con->prepare("select apps.* , categories.name as cat_name from apps,categories where apps.category_id = categories.id ORDER BY apps.id DESC");
        return $stmt->execute() ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }
}