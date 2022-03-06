<?php

class Route{

    private $routes = [
        'home' => ['index'],
        'books' => ['index'],
        'apps' => ['index'],
        'orders' => ['index','store'],
        'contact' => ['index','send'],
        'auth' => ['index','login','register','check_user','store'],
        'admin' => ['index']
    ];
    private $ensRoutes = [
        'home' => ['index'],
        'books' => ['index'],
        'apps' => ['index'],
        'orders' => ['index','store'],
        'posts' => ['store'],
        'contact' => ['index','send'],
        'auth' => ['index','login','register','logout','check_user','store','profile','update_profile'],
    ];
    private $subAdminRoutes = [
        'home' => ['index'],
        'categories' => ['index'],
        'books' => ['index'],
        'apps' => ['index'],
        'posts' => ['index','create','store','update','destroy','show'],
        'users' => ['index','show','update'],
        'messages' => ['index','show','destroy'],
        'auth' => ['index','login','logout','profile','update_profile'],
    ];
    private $adminRoutes = [
        'home' => ['index'],
        'categories' => ['index','create','edit','store','update','destroy'],
        'books' => ['index','create','edit','store','update','destroy'],
        'apps' => ['index','create','edit','store','update','destroy'],
        'posts' => ['index','create','store','update','destroy','show'],
        'users' => ['index','create','store','show','update','destroy'],
        'messages' => ['index','show','destroy','resp_messages','delete_city','assign_city'],
        'orders' => ['index','destroy','show','confirm'],
        'auth' => ['index','login','logout','profile','update_profile'],
    ];
    

    public function getList(Auth $auth){
        if($auth->isAdmin()){
            return $this->adminRoutes;
        }elseif($auth->isEns()){
            return $this->ensRoutes;
        }elseif($auth->isSubAdmin()){
            return $this->subAdminRoutes;
        }else{
            return $this->routes;
        }
    }
}