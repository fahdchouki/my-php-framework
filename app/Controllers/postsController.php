<?php

class postsController extends Controller{

    protected $postModel;

    public function __construct(){
        $this->postModel = new PostModel;
    }

    public function index(){
        if(auth()->isAdmin()){
            $data['posts'] = $this->postModel->getPosts();
            $data['users'] = (new Model)->table('users')->getWhere('role',3,null,'desc','!='); 
            return $this->view('admin' . DS . 'posts' . DS . 'index',$data);
        }elseif(auth()->isSubAdmin()){
            $subAdminId = intVal(auth()->getSubAdminID());
            $data['posts'] = $this->postModel->getPosts();
            $data['books'] = (new Model)->table('books')->getWhere('resp_user_id',$subAdminId,'id');
            return $this->view('admin' . DS . 'posts' . DS . 'index',$data);
        }else{
            redirect();
        }
    }

    public function show($id){
        if($data['post'] = $this->postModel->getPostWhere('id',intval($id))[0]){
            return $this->view('admin' . DS . 'posts' . DS . 'show',$data);
        }else{
            redirect('posts');
        }
    }

    public function create(){
        $data['books'] = (new Model)->table('books')->getAll();
        return $this->view('admin' . DS . 'posts' . DS . 'create',$data);
    }

    public function store(){
        if(isset($_POST['create_post'])){

            $data = [
                'body' => trim($_POST['post_body']),
                'file_path' => '',
                'book_id' => $_POST['book_id'],
            ];

            if(auth()->isAdmin()){
                $data['user_id'] = intval(auth()->getAdminID());
                $data['approve_status'] = $_POST['post_status'];
            }elseif(auth()->isSubAdmin()){
                $data['user_id'] = intval(auth()->getSubAdminID());
                $data['approve_status'] = $_POST['post_status'];
            }else{
                $data['user_id'] = intval(auth()->getEnsID());
                $data['approve_status'] = 0;
                if($_FILES['attachFile']['error'] != UPLOAD_ERR_NO_FILE){
                    $fileUpload = new Uploader;
                    $fileUpload->setDir(UPLOADS)->setMaxSize(50)->setExtensions(['jpg', 'jpeg', 'png', 'webp', 'jfif','pdf','doc','docx','ppt','pptx']);
                    if ($fileUpload->uploadFile('attachFile', true)) {
                        $data['file_path'] = $fileUpload->getUploadName();
                    } else {
                        $errors['file_path'] = $fileUpload->getMessage();
                    }
                }
            }

            $errors = array();

            if(empty($data['body'])){
                $errors['body'] = 'nothing to post';
            }

            if(empty($errors)){
                if($this->postModel->insert($data)){
                    (! auth()->isEns()) ? redirect('posts') : redirect('books');
                }else{
                    $errors['error'] = 'something went wrong';
                }
            }

            if(!empty($errors)){
                $errors['data'] = $data;
                (! auth()->isEns()) ? redirect('posts/create','errors',serialize($errors)) : redirect('books');
            }
        }else{
            redirect();
        }
    }

    public function update(){
        if(isset($_POST['accept_post'])){
            $this->postModel->update(array('approve_status' => 1),'id',$_POST['post_id']);
            redirect('posts');
        }else{
            redirect();
        }
    }

    public function destroy(){
        if(isset($_POST['post_id'])){
            if($this->postModel->delete('id',$_POST['post_id'])){
                redirect('posts');
            }else{
                $errors['error'] = 'something went wrong';
            }
            if(!empty($errors)){
                redirect('posts','errors',$errors);
            }
        }else{
            redirect();
        }
    }
}