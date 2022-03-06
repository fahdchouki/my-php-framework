<?php 

class App 
{
    private $_controller = "home";
    private $_action = "notfound";
    private $_params = array();
    public $routes = [];

    public function __construct()
    {
        $router = new Route;
        $this->routes = $router->getList(auth());
        $this->dispatch();
    }

    private function dispatch()
    {
        $url = explode("/",parse_url(trim($_SERVER['REQUEST_URI'],"/"),PHP_URL_PATH),3);

        $p1 = isset($url[0]) && $url[0] !== "" ? strtolower($url[0]) : '';
        $p2 = isset($url[1]) && $url[1] !== "" ? strtolower($url[1]) : '';
        $p3 = isset($url[2]) && $url[2] !== "" ? strtolower($url[2]) : '';

        $controllers = array_keys($this->routes);

        
        if(in_array($p1,$controllers)){

            $this->_controller = $p1;

            $modelObj = new Model;

            if(in_array($p2,$this->routes[$p1])){

                $this->_action = $p2;
                $this->_params = $p3 === '' ? [] : explode("/",$p3,1);

            }elseif($p2 == ''){

                $this->_action = 'index';

            }elseif(in_array($this->_controller,['categories','books','apps'])){
                if($slugObj = $modelObj->table($this->_controller)->getWhere('slug',$p2)){
                    $this->_action = 'show';
                    $this->_params = [$slugObj];
                }

            }
        }elseif($p1 == ''){
            $this->_controller = 'home';
            $this->_action = 'index';
        }else{
            $this->_controller = 'notfound';
        }

        $this->_controller = $this->_controller . "Controller";
        $obj = new $this->_controller;
        call_user_func_array([$obj,$this->_action],$this->_params);
        
    }
}