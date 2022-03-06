<?php

class Auth{

    private $session;

    public function __construct()
    {
        $this->session = new Session;
        $this->session->start();
    }

    //================= setting and checking private methods

    private function setUserSess($key){
        $this->session->set('user',[sha1($key),md5($_SERVER['HTTP_USER_AGENT'])]);
    }

    private function authCheck($key){
        if($this->session->is_exists('user')){
            if($this->session->get('user')[0] == sha1($key) 
            && $this->session->get('user')[1] == md5($_SERVER['HTTP_USER_AGENT'])){
                return true;
            }
        }
        return false;
    }

    //===========

    //======= setting user session methods

    public function setSessAdmin($id){
        $this->setUserSess('admin');
        $this->session->set('adminID',openssl_encrypt("$id","AES-128-CTR","MSMD3v"));
    }

    public function setSessEns($id){
        $this->setUserSess('enseignant');
        $this->session->set('ensID',openssl_encrypt("$id","AES-128-CTR","MSMD3v"));
    }
    
    public function setSessSubAdmin($id){
        $this->setUserSess('subadmin');
        $this->session->set('subadminID',openssl_encrypt("$id","AES-128-CTR","MSMD3v"));
    }

    public function getSubAdminID(){
        return openssl_decrypt($this->session->get('subadminID'),"AES-128-CTR","MSMD3v");
    }

    public function getAdminID(){
        return openssl_decrypt($this->session->get('adminID'),"AES-128-CTR","MSMD3v");
    }

    public function getEnsID(){
        return openssl_decrypt($this->session->get('ensID'),"AES-128-CTR","MSMD3v");
    }

    //================

    public function isAdmin(){      
        return $this->authCheck('admin');
    }

    public function isEns(){
        return $this->authCheck('enseignant');
    }

    public function isSubAdmin(){
        return $this->authCheck('subadmin');
    }

    public function isLogged(){
        return $this->isAdmin() || $this->isSubAdmin() || $this->isEns();
    }
}