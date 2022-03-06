<?php 

class homeController extends Controller{

    public function index()
    {
        if(auth()->isAdmin() || auth()->isSubAdmin()){
            $data['books'] = (new BookModel)->getAll('*','id');
            $data['orders'] = (new OrderModel)->getOrders();
            $data['messages'] = (new Model)->table('messages')->getAll('*','id');
            $data['teachers'] = (new UserModel)->getWhere('role',3,'id');
            return $this->view('admin'. DS .'index',$data);
        }else{
            return $this->view('index');
        }
    }
    
}