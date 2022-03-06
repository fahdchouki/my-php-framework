<?php

class contactController extends Controller{

    public function index(){
        return auth()->isAdmin() || auth()->isSubAdmin() ? redirect() : $this->view('contact');
    }

    public function send(){
        if(isset($_POST['send'])){
            $data = [
                'name' => trim($_POST['name']),
                'phone' => trim($_POST['phone']),
                'email' => trim($_POST['email']),
                'city_id' => intval($_POST['city']),
                'subject' => trim($_POST['subject']),
                'message' => trim($_POST['message']),
            ];
            $errors = array();
            if(!valid_string($data['name']) || strlen($data['name']) < 4){
                $errors['name'] = 'invalid name';
            }
            if(!valid_phone($data['phone']) || strlen($data['phone']) < 8){
                $errors['phone'] = 'invalid phone';
            }
            if(!valid_email($data['email'])){
                $errors['email'] = 'invalid email';
            }
            if(strlen($data['message']) < 15){
                $errors['message'] = 'too short message';
            }

            if(empty($errors)){
                $data['subject'] = filterString($data['subject']);
                $data['message'] = filterString($data['message']);
                if((new Model)->table('messages')->insert($data)){
                    $data['message'] .= "\n\n\n" . $data['name'] . "\n" . $data['phone'] . "\n" . $data['email'] . "\n";
                    mail("sbaribi@gmail.com", $data['subject'],$data['message']);
                    redirect('contact','msgSent','message sent successfully');
                }else{
                    redirect('contact','msgNotSent','message unfortunatly not sent');
                }
            }else{
                redirect('contact','errors',$errors);
            }
        }else{
            redirect('contact');
        }
    }
    
}