<?php

class Session
{
    public function __construct()
    {
        // $this->start();
    }
    public function start()
    {
        if('' === session_id()) {
            session_start();
        }
    }

    public function get($key) {
        if(isset($_SESSION[$key])) {
            $data = @unserialize($_SESSION[$key]);
            if($data === false) {
                return $_SESSION[$key];
            } else {
                return $data;
            }
        } else {
            trigger_error('No session key ' . $key . ' exists', E_USER_NOTICE);
        }
    }

    public function set($key, $value) {
        if(is_array($value)) {
            $_SESSION[$key] = serialize($value);
        } else {
            $_SESSION[$key] = $value;
        }
    }

    public function is_exists($key)
    {
        return isset($_SESSION[$key]) ? true : false;
    }

    public function delete($key)
    {
        unset($_SESSION[$key]);
    }


    public function renew()
    {
        return session_regenerate_id();
    }

    public function kill()
    {
        session_unset();
        session_destroy();
    }

}