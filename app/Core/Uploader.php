<?php

class Uploader{
    private $destinationPath;
    private $errorMessage;
    private $extensions;
    private $maxSize;
    private $uploadName;

    //start with this method   1

    function setDir($path){
        $this->destinationPath  =   $path;
        return $this;
    }

    //then this       2

    function setMaxSize($sizeMB){
        $this->maxSize  =   $sizeMB * (1024*1024);
        return $this;
    }

    //then this      3

    function setExtensions($options){ // array of extensions like ['png','jpg']
        $this->extensions   =   $options;
        return $this;
    }

    function setMessage($message){
        $this->errorMessage =   $message;
    }

    //get error if upload failed    6

    function getMessage(){
        return $this->errorMessage;
    }


    // after no error to store this name in DB    5

    function getUploadName(){
        return $this->uploadName;
    }


    //then this    4

    function uploadFile($fileBrowse,$useRandStart = false){
        $result =   false;
        $size   =   $_FILES[$fileBrowse]["size"];
        $name   =   $_FILES[$fileBrowse]["name"];
        $ext    =   pathinfo($name,PATHINFO_EXTENSION);

        $this->uploadName=  ($useRandStart ? rand(11,99999999) . '_' : '') . strtolower(str_replace(' ','',$name));

        if(empty($name))
        {
            $this->setMessage("File not selected ");
        }
        else if($size>$this->maxSize)
        {
            $this->setMessage("Too large file !");
        }
        else if(in_array($ext,$this->extensions))
        {
            if(!is_dir($this->destinationPath))
                mkdir($this->destinationPath);

            if(!is_writable($this->destinationPath))
                $this->setMessage("Destination is not writable !");
            else
            {
                if(move_uploaded_file($_FILES[$fileBrowse]["tmp_name"],$this->destinationPath . $this->uploadName))
                {
                    $result =   true;
                }
                else
                {
                    $this->setMessage("Upload failed , try later !");
                }
            }
        }
        else
        {
            $this->setMessage("Invalid file format !");
        }
        return $result;
    }
}