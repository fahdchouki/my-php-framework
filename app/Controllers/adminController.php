<?php
class adminController extends Controller{
    public function index(){
        return $this->view('login_admin');
    }
}