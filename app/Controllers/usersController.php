<?php

class usersController extends Controller{

    const APPROVED = 1;
    const NOT_APPROVED = 0;

    public function __construct(){
        $this->userModel = new UserModel;
    }

    public function index(){
        $data['users'] = $this->userModel->getAll('*','id');
        return $this->view('admin' . DS . 'users' . DS . 'index',$data);
    }

    public function show($user){
        if(valid_username($user) && (auth()->isAdmin() || auth()->isSubAdmin())){
            if($user = $this->userModel->getWhere('username',$user)){
                $data['user'] = $user[0];
                $data['user']['city'] = 'unknown';
                if($city = (new Model)->table('ville')->getWhere('id',intval($data['user']['city_id']))){
                    $data['user']['city'] = $city[0]['ville'];
                }
                return $this->view('admin' . DS . 'users' . DS . 'show',$data);
            }
        }else{
            redirect();
        }
    }

    public function create(){
        return $this->view('admin' . DS . 'users' . DS . 'create');
    }

    public function store(){
        if(isset($_POST['create_user'])){

            $data = [
                'fullname' => trim($_POST['fullname']),
                'username' => trim($_POST['username']),
                'password' => $_POST['password'],
                'role' => $_POST['role'],
                'email' => trim($_POST['email']),
                'phone' => trim($_POST['phone']),
                'class' => trim($_POST['class']),
                'city_id' => trim($_POST['city']),
            ];

            $errors = array();

            if(valid_username($data['username']) && strlen($data['username']) > 4){
                if(! $this->userModel->is_unique('username',$data['username'])){
                    $errors['username'] = 'this username is already taken';
                }
            }else{
                $errors['username'] = 'username must be mor than 4 character and contains only letters, numbers and _';
            }

            if(valid_email($data['email'])){
                if(! $this->userModel->is_unique('email',$data['email'])){
                    $errors['email'] = 'this email is already taken';
                }
            }elseif(!empty($data['email'])){
                $errors['email'] = 'please use a valid email address';
            }

            if(valid_string($data['fullname'])){
                if(strlen($data['fullname']) < 4) $errors['fullname'] = 'please enter a valid name';
            }else{
                $errors['fullname'] = 'please enter a valid name';
            }

            if(valid_phone($data['phone'])){
                if(strlen($data['phone']) < 10) $errors['phone'] = 'please enter a valid phone';
            }elseif(!empty($data['phone'])){
                $errors['phone'] = 'please enter a valid phone';
            }

            if(valid_string($data['class'],true)){
                if(strlen($data['class']) < 3) $errors['class'] = 'please enter a valid class';
            }elseif(!empty($data['class'])){
                $errors['class'] = 'please enter a valid class';
            }

            if(strlen($data['password']) < 8){
                $errors['password'] = 'please enter a strong password';
            }

            if(empty($errors)){
                $data['password'] = crypt_password($_POST['password']);
                $data['approve_status'] = self::APPROVED;
                if($this->userModel->insert($data)){
                    redirect('users');
                }else{
                    $errors['error'] = 'something went wrong';
                }
            }

            if(!empty($errors)){
                $errors['data'] = $data;
                redirect('users/create','errors',serialize($errors));
            }
        }else{
            redirect();
        }
    }

    public function update(){
        if(isset($_POST['accept_user'])){
            $this->userModel->update(array('approve_status' => self::APPROVED),'id',$_POST['user_id']);
            redirect('users');
        }
        redirect();
    }

    public function destroy(){
        if(isset($_POST['user_id'])){
            if($this->userModel->delete('id',$_POST['user_id'])){
                redirect('users');
            }else{
                $errors['error'] = 'something went wrong';
            }
            if(!empty($errors)){
                redirect('users','errors',$errors);
            }
        }else{
            redirect();
        }
    }
}