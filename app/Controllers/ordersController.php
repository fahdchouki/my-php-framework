<?php

class ordersController extends Controller
{
    protected $orderModel;

    public function __construct(){
        $this->orderModel = new OrderModel;
    }

    public function index()
    {
        if(auth()->isAdmin()){
            $data['orders'] = $this->orderModel->getOrders();
            return $this->view('admin' . DS . 'orders' . DS . 'index',$data);
        }else{
            if (isset($_COOKIE['prods'])) {
                $data['cartProds'] = json_decode($_COOKIE['prods']);
                $data['books'] = (new BookModel)->getWhere('pub_status', '1');
                return $this->view('cart', $data);
            }
            return $this->view('cart');
        }
    }

    public function show($id)
    {
        if($data['order'] = $this->orderModel->getOrderWhere('id',intval($id))[0]){
            return $this->view('admin' . DS . 'orders' . DS . 'show',$data);
        }else{
            redirect('orders');
        }
    }

    public function store()
    {
        if (isset($_POST['checkout'])) {
            $data = [
                'client_name' => trim($_POST['fullname']),
                'client_phone' => trim($_POST['phone']),
                'client_email' => trim($_POST['email']),
                'client_address' => trim($_POST['address']),
                'status' => 0,
            ];

            $errors = array();

            if (!valid_string($data['client_name']) || strlen($data['client_name']) < 4) {
                $errors['client_name'] = 'username must be mor than 4 character and contains only letters, numbers and _';
            }
            if (!valid_phone($data['client_phone']) || strlen($data['client_phone']) < 8) {
                $errors['client_phone'] = 'invalid phone';
            }
            if (!valid_email($data['client_email']) || strlen($data['client_email']) < 4) {
                $errors['client_email'] = 'invalid email';
            }
            if (!valid_string($data['client_address'],true) || strlen($data['client_address']) < 4) {
                $errors['client_address'] = 'invalid address';
            }

            if(empty($errors)){
                if (isset($_COOKIE['prods'])) {
                    $cartProds = json_decode($_COOKIE['prods']);
                    if (!empty($cartProds)) {
                        foreach ($cartProds as $prod) {
                            $data['product_id'] = intval($prod[0]);
                            $data['quantity'] = intval($prod[1]);
                            if (! (new Model)->table('orders')->insert($data)) {
                                redirect('orders','wrong','something went wrong');
                            }
                        }
                        setcookie('prods', null, time() - 3600, "/");
                        redirect('orders','success','your order is successfully submitted');
                    }else{
                        redirect('orders');
                    }
                }else{
                    redirect('orders');
                }
            }else{
                redirect('orders','errors',$errors);
            }
        }else{
            redirect();
        }
    }

    public function confirm()
    {
        if(isset($_POST['accept_order'])){
            $this->orderModel->update(array('status' => 1),'id',$_POST['order_id']);
            redirect('orders');
        }else{
            redirect();
        }
    }

    public function destroy()
    {
        if(isset($_POST['order_id'])){
            if($this->orderModel->delete('id',$_POST['order_id'])){
                redirect('orders');
            }else{
                $errors['error'] = 'something went wrong';
            }
            if(!empty($errors)){
                redirect('orders','errors',$errors);
            }
        }else{
            redirect();
        }
    }
}
