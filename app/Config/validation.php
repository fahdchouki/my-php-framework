<?php

function valid_username($username){
    $array = str_split($username);
    $valid = true;
    foreach ($array as $char) {
        if(!ctype_alnum($char) && $char != '_'){
            $valid = false;
        }
    }
    return $valid;
}

function valid_phone($phone){
    $array = str_split($phone);
    $array[0] == '+' ? array_shift($array) : null;
    $valid = true;
    foreach ($array as $char) {
        if(!ctype_digit($char)){
            $valid = false;
        }
    }
    return $valid;
}

function valid_string($str,$acceptNum = false,$acceptSpecialChars = false){
    $array = str_split(trim(strtolower($str)));
    $valid = true;
    $specialChars = $acceptSpecialChars ? ' ,-çéâêîôûàèìòùëïü' : ' ';
    foreach ($array as $char) {
        if(!($acceptNum ? ctype_alnum($char) : ctype_alpha($char)) && !str_contains($specialChars,$char)){
            $valid = false;
        }
    }
    return $valid;
}

function valid_email($email){
    return filter_var($email,FILTER_VALIDATE_EMAIL);
}

function valid_slug($slug){
    $array = str_split($slug);
    $valid = true;
    foreach ($array as $char) {
        if(! ctype_alnum($char) && $char != '-'){
            $valid = false;
        }
    }
    return $valid;
}

/*============================== FILTERS =====================*/

function filterInt($input)
{
    return filter_var($input, FILTER_SANITIZE_NUMBER_INT);
}

function filterFloat($input)
{
    return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
}

function filterString($input)
{
    return htmlentities(strip_tags($input), ENT_QUOTES, 'UTF-8');
}

function filter_username($username){
    $array = str_split($username);
    $san_user = "";
    foreach ($array as $char) {
        $san_user .= ctype_alnum($char) || $char == '_' ? $char : '';
    }
    return $san_user;
}

/*================ PASSWORD HASHING ============*/
function crypt_password($pwd){
    return sha1(md5($pwd));
}
/**==============Slug=============== */

function make_slug($str){
    $array = str_split($str);
    $san_slug = "";
    foreach ($array as $char) {
        $san_slug .= ctype_alnum($char) || $char == ' ' ? $char : '';
    }
    return str_replace(' ','-',strtolower($san_slug));
}