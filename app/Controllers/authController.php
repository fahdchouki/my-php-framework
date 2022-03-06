<?php

class authController extends Controller{

    const USER_ADMIN = 1;
    const USER_SUB_ADMIN = 2;
    const USER_ENS = 3;
    const APPROVED = 1;
    const NOT_APPROVED = 0;

    protected $userModel;
    public $user;

    public function __construct(){
        $this->userModel = new UserModel;
    }

    public function index(){
        return $this->view('login');
    }

    public function login(){
        return auth()->isLogged() ? redirect() : $this->view('login');
    }

    public function register(){
        return auth()->isLogged() ? redirect() : $this->view('register');
    }

    public function check_user(){

        if(isset($_POST['login'])){

            $username = filter_username($_POST['username']);
            $password = crypt_password($_POST['password']);

            if($this->user = $this->userModel->isUserExist($username,$password)){

                if($this->user['role'] == self::USER_ADMIN){
                    auth()->setSessAdmin($this->user['id']);
                    redirect();
                }elseif($this->user['role'] == self::USER_SUB_ADMIN){
                    auth()->setSessSubAdmin($this->user['id']);
                    redirect();
                }elseif($this->user['role'] == self::USER_ENS){
                    auth()->setSessEns($this->user['id']);
                    redirect();
                }

            }

            redirect('auth/login','wrong','invalid username or password');

        }else{
            redirect();
        }
    }

    public function store(){
        if(isset($_POST['register'])){

            $data = [
                'fullname' => trim($_POST['fullname']),
                'username' => strtolower(trim($_POST['username'])),
                'email' => trim($_POST['email']),
                'phone' => trim($_POST['phone']),
                'city_id' => intval($_POST['city']),
                'class' => trim($_POST['class']),
                'school' => trim($_POST['school']),
                'password' => $_POST['password'],
            ];

            $errors = array();

            if(valid_username($data['username']) && strlen($data['username']) > 4){
                if(! $this->userModel->is_unique('username',$data['username'])){
                    $errors['username'] = 'this username is already taken';
                }
            }else{
                $errors['username'] = 'username must be mor than 4 character and contains only letters, numbers and _';
            }

            if(valid_email($data['email']) && !empty($data['email'])){
                if(! $this->userModel->is_unique('email',$data['email'])){
                    $errors['email'] = 'this email is already taken';
                }
            }else{
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

            if(!valid_string($data['class'],true,true) || strlen($data['class']) < 2){
                $errors['class'] = 'please enter a valid class';
            }

            if(!valid_string($data['school'],true,true) || strlen($data['school']) < 2){
                $errors['school'] = 'please enter a valid school';
            }

            if(strlen($data['password']) < 8){
                $errors['password'] = 'please enter a strong password';
            }

            if(empty($errors)){
                $data['password'] = crypt_password($_POST['password']);
                $data['role'] = self::USER_ENS;
                $data['approve_status'] = self::NOT_APPROVED;
                if($this->userModel->insert($data)){
                    redirect('auth/login');
                }else{
                    $errors['error'] = 'something went wrong';
                }
            }

            if(!empty($errors)){
                $errors['data'] = $data;
                redirect('auth/register','errors',$errors);
            }
        }else{
            redirect();
        }
    }

    public function update_profile(){
        if(isset($_POST['update_profile'])){

            $data = [
                'fullname' => trim($_POST['fullname']),
                'username' => strtolower(trim($_POST['username'])),
            ];

            $errors = array();

            if(valid_username($data['username']) && strlen($data['username']) > 4){
                if(! $this->userModel->is_unique_except('username',$data['username'],trim($_POST['old_username']))){
                    $errors['username'] = 'this username is already taken';
                }
            }else{
                $errors['username'] = 'username must be mor than 4 character and contains only letters, numbers and _';
            }

            if(valid_string($data['fullname'])){
                if(strlen($data['fullname']) < 4) $errors['fullname'] = 'please enter a valid name';
            }else{
                $errors['fullname'] = 'please enter a valid name';
            }


            if(!empty(trim($_POST['password']))){
                $data['password'] = trim($_POST['password']);
                if(strlen($data['password']) < 8){
                    $errors['password'] = 'please enter a strong password';
                }else{
                    $data['password'] = crypt_password($data['password']);
                }
            }

            if(empty($errors)){
                if($this->userModel->update($data,'id',intval($_POST['user_id']))){
                    redirect('auth/profile','success','profile updated');
                }else{
                    $errors['error'] = 'something went wrong';
                }
            }

            if(!empty($errors)){
                redirect('auth/profile','errors',$errors);
            }
        }else{
            redirect();
        }
    }

    public function profile(){
        if(auth()->isLogged()){
            if(auth()->isAdmin()){
                $data['infoUser'] = (new UserModel)->getWhere('id',auth()->getAdminID())[0];
            }elseif(auth()->isSubAdmin()){
                $data['infoUser'] = (new UserModel)->getWhere('id',auth()->getSubAdminID())[0];
            }else{
                $data['infoUser'] = (new UserModel)->getWhere('id',auth()->getEnsID())[0];
                return $this->view('profile',$data);
            }
            return $this->view('admin' . DS . 'profile',$data);
        }else{
            redirect();
        }
    }

    public function logout(){
        if(auth()->isLogged()){
            session_unset();
            session_destroy();
        }
        redirect(url());
    }

}