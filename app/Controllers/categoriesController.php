<?php

class categoriesController extends Controller{

    protected $catModel;

    public function __construct(){
        $this->catModel = new CategoryModel;
    }

    public function index(){
        $data['cats'] = $this->catModel->getAll('*','id');
        return auth()->isAdmin() || auth()->isSubAdmin() ?
         $this->view('admin' . DS . 'categories' . DS . 'index',$data) :
         $this->view('categories',$data);
    }

    public function show($data){
        $data['single_cat'] = $data[0];
        return auth()->isAdmin() ?
                $this->edit($data['single_cat']['slug']) :
                $this->view('categories',$data);
    }

    public function create(){
        return $this->view('admin' . DS . 'categories' . DS . 'create');
    }

    public function store(){
        if(isset($_POST['create_cat'])){

            $data = [
                'name' => trim($_POST['cat_name']),
                'description' => trim($_POST['cat_desc']),
            ];

            $errors = array();

            if(strlen($data['name']) > 4){
                if(! $this->catModel->is_unique('name',$data['name'])){
                    $errors['name'] = 'this name is already taken';
                }
            }else{
                $errors['name'] = 'name must be mor than 4 character and contains only letters and numbers';
            }

            if(empty($errors)){
                $data['slug'] = make_slug($data['name']);
                if($this->catModel->insert($data)){
                    redirect('categories');
                }else{
                    $errors['error'] = 'something went wrong';
                }
            }

            if(!empty($errors)){
                $errors['data'] = $data;
                redirect('categories/create','errors',serialize($errors));
            }
        }else{
            redirect();
        }
    }

    public function edit($slug){
        if($data['cat'] = $this->catModel->getWhere('slug',$slug)[0]){
             return $this->view('admin' . DS . 'categories' . DS . 'edit',$data);
        }
        return $this->view('admin' . DS . 'categories');
    }

    public function update(){
        if(isset($_POST['update_cat']) && isset($_POST['cat_id'])){

            $data = [
                'name' => trim($_POST['cat_name']),
                
            ];

            $errors = array();

            if(valid_string($data['name'],true) && strlen($data['name']) > 4){
                if(! $this->catModel->is_unique_except('name',$data['name'],trim($_POST['old_name']))){
                    $errors['name'] = 'this name is already taken';
                }
            }else{
                $errors['name'] = 'name must be mor than 4 character and contains only letters and numbers';
            }

            if(empty($errors)){
                $data['slug'] = make_slug($data['name']);
                $data['description'] = trim($_POST['cat_desc']);

                if($this->catModel->update($data,'id',intval($_POST['cat_id']))){
                    redirect('categories');
                }else{
                    $errors['error'] = 'something went wrong';
                }
            }

            if(!empty($errors)){
                $errors['data'] = $data;
                redirect('categories/edit/' . trim($_POST['old_slug']),'errors',serialize($errors));
            }
        }else{
            redirect();
        }
    }

    public function destroy(){
        if(isset($_POST['cat_id'])){
            if($this->catModel->delete('id',$_POST['cat_id'])){
                redirect('categories');
            }else{
                $errors['error'] = 'something went wrong';
            }
            if(!empty($errors)){
                redirect('categories','errors',$errors);
            }
        }else{
            redirect();
        }
    }
}