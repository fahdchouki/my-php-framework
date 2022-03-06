<?php 

// define routes 
function url($url='')
{
    echo BURL . $url;
}
// auth function return object of Auth
function auth(){
    return new Auth;
}
// redirect with optional flash message
function redirect($url='',$msgKey = null,$message=null)
{
    if($msgKey !== null){
        if(is_array($message)){
            setcookie($msgKey,serialize($message),
                    time()+5,'/','',
                    (strtolower($_SERVER['REQUEST_SCHEME']) === 'http' ? false : true),
                    true
            );
        }else{
            setcookie($msgKey,$message,
                    time()+5,'/','',
                    (strtolower($_SERVER['REQUEST_SCHEME']) === 'http' ? false : true),
                    true
            );
        }
    }
    header("location:" . BURL.$url);
    exit;
}

//dump an array or object
function pre($arr){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
    die();
}

// excerpt function to get a part of string

function excerpt($text,$numOfChars = 10){
    return strlen($text) < $numOfChars ? mb_substr($text,0,$numOfChars) . '...' : $text;
}

// format date function

function formatDate($date){
    return date_format(date_create($date), 'd-m-Y');
}

// cities functions
function getCities(){
    return (new Model)->table('ville')->getAll();
}