<?php

class appsController extends Controller{

    public function index(){
        $data['apps'] = (new AppModel)->getApps();
        $data['cats'] = (new CategoryModel)->getAll();
        $data['apps_cats_null'] = (new AppModel)->getWhere('category_id',null,'id');

        if(auth()->isAdmin() || auth()->isSubAdmin()){
            return $this->view('admin' . DS . 'apps' . DS . 'index',$data);   
        }else{
            if (isset($_GET['query_search']) && !empty($_GET['query_search'])) {
                $data['search'] = filterString($_GET['query_search']);
                $allApps = array_merge($data['apps'], $data['apps_cats_null']);
                $foundedApps = [];
                foreach ($allApps as $app) {
                    if (strpos(strtolower($app['title']), strtolower($data['search'])) !== false
                    || strpos(strtolower($app['description']), strtolower($data['search'])) !== false) {
                        $foundedApps[] = $app;
                    }
                }
                $data['cats'] = [];
                $data['apps'] = [];
                $data['apps_cats_null'] = $foundedApps;
                if(empty($data['apps_cats_null'])) $data['result'] = '';
            }
            return $this->view('apps', $data);
        }
    }

    public function show($app){
        $data['app'] = $app[0];
        return $data['app']['status'] == 1 ? $this->view('app',$data) : $this->view('404');
    }

    public function create(){
        $data['cats'] = (new CategoryModel)->getAll();
        return $this->view('admin' . DS . 'apps' . DS . 'create',$data);
    }

    public function store(){
        if(isset($_POST['create_app'])){
            $data = [
                'title' => trim($_POST['app_title']),
                'slug' => trim($_POST['app_slug']),
                'description' => trim($_POST['app_desc']),
                'status' => $_POST['app_status'],
                'category_id' => $_POST['app_category'],
                'apk_link' => trim($_POST['app_link']),
            ];

            $errors = array();

            if(strlen($data['title']) > 4){
                if(! (new Model)->table('apps')->is_unique('title',$data['title'])){
                    $errors['title'] = 'this title is already taken';
                }
            }else{
                $errors['title'] = 'title must be more than 4 character and contains letters and numbers';
            }

            if(valid_slug($data['slug'])){
                if(! (new AppModel)->is_unique('slug',$data['slug'])){
                    $errors['slug'] = 'this slug is already taken';
                }
            }elseif(!empty($data['slug'])){
                $errors['slug'] = 'slug must be like example-example-example';
            }

            if(empty($errors)){
                $fileUpload = new Uploader;
                $fileUpload->setDir(UPLOADS)->setMaxSize(5)->setExtensions(['jpg','jpeg','png','webp','jfif']);

                // app image

                if($fileUpload->uploadFile('app_image',true)){
                    $data['apk_image'] = $fileUpload->getUploadName();
                }else{
                    $errors['apk_image'] = $fileUpload->getMessage();
                }

                // app file
                if(isset($_FILES['app_file']) && $_FILES['app_file']['error'] != UPLOAD_ERR_NO_FILE) {
                    $fileUpload->setMaxSize(300)->setExtensions(['apk']);

                    if($fileUpload->uploadFile('app_file',true)){
                        $data['apk_path'] = $fileUpload->getUploadName();
                    }else{
                        $errors['apk_path'] = $fileUpload->getMessage();
                    }
                }

                if(empty($errors)){
                    $data['slug'] = empty($data['slug']) ? make_slug($data['title']) : $data['slug'];
                    if((new Model)->table('apps')->insert($data)){
                        redirect('apps');
                    }else{
                        $errors['error'] = 'something went wrong';
                    }
                }
            }

            if(!empty($errors)){
                $errors['data'] = $data;
                redirect('apps/create','errors',$errors);
            }
        }else{
            redirect();
        }
    }

    public function edit($slug){
        if($data['app'] = (new Model)->table('apps')->getWhere('slug',$slug)[0]){
            $data['cats'] = (new CategoryModel)->getAll();
            return $this->view('admin' . DS . 'apps' . DS . 'edit',$data);
        }
        return $this->view('admin' . DS . 'apps');
    }

    public function update(){
        if(isset($_POST['update_app']) && isset($_POST['app_id'])){

            $data = [
                'title' => trim($_POST['app_title']),
                'slug' => trim($_POST['app_slug']),
                'description' => trim($_POST['app_desc']),
                'apk_link' => trim($_POST['app_link']),
                'status' => $_POST['app_status'],
                'category_id' => $_POST['app_category'],
            ];

            $errors = array();

            if(strlen($data['title']) > 4){
                if(! (new AppModel)->is_unique_except('title',$data['title'],trim($_POST['old_title']))){
                    $errors['title'] = 'this title is already taken';
                }
            }else{
                $errors['title'] = 'Title must be mor than 4 characters';
            }

            if(valid_slug($data['slug'])){
                if(! (new AppModel)->is_unique_except('slug',$data['slug'],trim($_POST['old_slug']))){
                    $errors['slug'] = 'this slug is already taken';
                }
            }else{
                $errors['slug'] = 'slug must be like example-example-example';
            }

            if(isset($_FILES['app_image']) && $_FILES['app_image']['error'] != UPLOAD_ERR_NO_FILE) {
                $fileUpload = new Uploader;
                $fileUpload->setDir(UPLOADS)->setMaxSize(5)->setExtensions(['jpg','jpeg','png','webp','jfif']);
                if($fileUpload->uploadFile('app_image',true)){
                    $data['apk_image'] = $fileUpload->getUploadName();
                }else{
                    $errors['image'] = $fileUpload->getMessage();
                }
            }

            if(isset($_FILES['app_file']) && $_FILES['app_file']['error'] != UPLOAD_ERR_NO_FILE) {
                $fileUpload = new Uploader;
                $fileUpload->setDir(UPLOADS)->setMaxSize(500)->setExtensions(['apk']);
                if($fileUpload->uploadFile('app_file',true)){
                    $data['apk_path'] = $fileUpload->getUploadName();
                }else{
                    $errors['app_file'] = $fileUpload->getMessage();
                }
            }

            if(empty($errors)){

                if((new Model)->table('apps')->update($data,'id',$_POST['app_id'])){
                    redirect('apps');
                }else{
                    $errors['error'] = 'something went wrong';
                }
            }

            if(!empty($errors)){
                $errors['data'] = $data;
                redirect('apps/edit/' . trim($_POST['old_slug']),'errors',$errors);
            }
        }else{
            redirect();
        }
    }

    public function destroy(){
        if(isset($_POST['app_id'])){
            if((new AppModel)->delete('id',$_POST['app_id'])){
                @unlink(UPLOADS . $_POST['app_img']);
                @unlink(UPLOADS . $_POST['app_file']);
                redirect('apps');
            }else{
                $errors['error'] = 'something went wrong';
            }
            if(!empty($errors)){
                redirect('apps','errors',$errors);
            }
        }else{
            redirect();
        }
    }
}