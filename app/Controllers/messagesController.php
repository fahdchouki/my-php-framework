<?php

class messagesController extends Controller{

    public function index(){
        $data['msgs'] = (new Model)->table('messages')->getAll();
        if(auth()->isSubAdmin()){
            $cities_ids = (new Model)->table('users')->getWhere('id',auth()->getSubAdminID())[0]['resp_cities'];
            $cities_ids = explode(',',$cities_ids);
            $msgs = $data['msgs'];
            $data['msgs'] = [];
            foreach($msgs as $msg){
                if(in_array($msg['city_id'],$cities_ids)){
                    $data['msgs'][] = $msg;
                }
            }
        }
        return $this->view('admin' . DS . 'messages',$data);
    }

    public function show($id){
        if($message = (new Model)->table('messages')->getWhere('id',intval($id))[0]){
            $data['msg'] = $message;
            return $this->view('admin' . DS . 'message',$data);
        }else{
            redirect('messages');
        }
    }

    public function resp_messages(){
        $data['subAdmins'] = (new Model)->table('users')->getWhere('role',2); 
        return $this->view('admin' . DS . 'resp_messages',$data);
    }

    public function destroy(){
        if(isset($_POST['msg_id'])){
            if((new Model)->table('messages')->delete('id',$_POST['msg_id'])){
                redirect('messages');
            }else{
                $errors['error'] = 'something went wrong';
            }
            if(!empty($errors)){
                redirect('messages','errors',$errors);
            }
        }else{
            redirect();
        }
    }

    public function assign_city(){
        if(isset($_POST['submit'])){
            $resp_id = intval($_POST['subAdmin_id']);
            $city_id = intval($_POST['city_id']);
            $subAdmin_cities = explode(',',trim((new Model)->table('users')->getWhere('id',$resp_id)[0]['resp_cities'],','));
            if(in_array($city_id,$subAdmin_cities)){
                redirect('messages/resp_messages','error','city already exist');
            }else{           
                array_push($subAdmin_cities,$city_id);
                $data['resp_cities'] = implode(",",$subAdmin_cities);
                if((new Model)->table('users')->update($data,'id',$resp_id)){
                    redirect('messages/resp_messages');
                }else{
                    redirect();
                }
            }

        }else{
            redirect();
        }
    }

    public function delete_city(){
        if(isset($_POST['submit'])){
            $resp_id = intval($_POST['resp_id']);
            $city_id = intval($_POST['city_id']);

            $subAdmin_cities = explode(',',trim((new Model)->table('users')->getWhere('id',$resp_id)[0]['resp_cities']));
            $newCities = "";
            foreach($subAdmin_cities as $sa_c){
                if($sa_c != $city_id){
                    $newCities .= $sa_c . ",";
                }
            }
            $data['resp_cities'] = trim($newCities,',');
            if((new Model)->table('users')->update($data,'id',$resp_id)){
                redirect('messages/resp_messages');
            }else{
                redirect();
            }
        }else{
            redirect();
        }
    }
}