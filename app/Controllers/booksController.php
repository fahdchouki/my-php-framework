<?php

class booksController extends Controller
{

    public function index()
    {
        $data['books'] = (new BookModel)->getBooks();
        $data['cats'] = (new CategoryModel)->getAll();
        $data['books_cats_null'] = (new BookModel)->getWhere('category_id', null, 'id');
        if (auth()->isAdmin() || auth()->isSubAdmin()) {
            $data['users'] = (new UserModel)->getWhere('role', 3, 'id', 'desc', '!=');
            return $this->view('admin' . DS . 'books' . DS . 'index', $data);
        } else {
            if (isset($_GET['query_search']) && !empty($_GET['query_search'])) {
                $data['search'] = filterString($_GET['query_search']);
                $allBooks = array_merge($data['books'], $data['books_cats_null']);
                $foundedBooks = [];
                foreach ($allBooks as $book) {
                    if (strpos(strtolower($book['title']), strtolower($data['search'])) !== false
                    || strpos(strtolower($book['description']), strtolower($data['search'])) !== false) {
                        $foundedBooks[] = $book;
                    }
                }
                $data['cats'] = [];
                $data['books'] = [];
                $data['books_cats_null'] = $foundedBooks;
                if(empty($data['books_cats_null'])) $data['result'] = '';
            }
            return $this->view('books', $data);
        }
    }

    public function show($book)
    {
        if (!auth()->isAdmin()) {
            if(auth()->isEns()){
                $userStatus = (new Model)->table('users')->getWhere('id',auth()->getEnsID())[0]['approve_status'];
                if($userStatus == 1){
                    $data['posts'] = (new PostModel)->getPosts();
                }
            }
            $data['book'] = $book[0];
            $data['ens_status'] = $userStatus;
            return $data['book']['pub_status'] == 1 ? $this->view('book', $data) : $this->view('404');
        } else {
            redirect('books');
        }
    }

    public function create()
    {
        $data['users'] = (new UserModel)->getAll();
        $data['cats'] = (new CategoryModel)->getAll();
        return $this->view('admin' . DS . 'books' . DS . 'create', $data);
    }

    public function store()
    {
        if (isset($_POST['create_bk'])) {
            $data = [
                'title' => trim($_POST['bk_title']),
                'slug' => trim($_POST['bk_slug']),
                'description' => trim($_POST['bk_desc']),
                'pub_status' => $_POST['bk_status'],
                'price' => $_POST['bk_price'],
                'resp_user_id' => $_POST['bk_resp'],
                'category_id' => $_POST['bk_category'],
            ];

            $errors = array();

            if (strlen($data['title']) > 4) {
                if (!(new Model)->table('books')->is_unique('title', $data['title'])) {
                    $errors['title'] = 'this title is already taken';
                }
            } else {
                $errors['title'] = 'title must be mor than 4 character and contains letters and numbers';
            }

            if (valid_slug($data['slug'])) {
                if (!(new BookModel)->is_unique('slug', $data['slug'])) {
                    $errors['slug'] = 'this slug is already taken';
                }
            } elseif (!empty($data['slug'])) {
                $errors['slug'] = 'slug must be like example-example-example';
            }

            if (doubleval($data['price']) < 1 || empty($data['price'])) {
                $errors['price'] = 'please enter a valid price';
            }

            if (empty($errors)) {
                $fileUpload = new Uploader;
                $fileUpload->setDir(UPLOADS)->setMaxSize(10)->setExtensions(['jpg', 'jpeg', 'png', 'webp', 'jfif']);
                if ($fileUpload->uploadFile('bk_image', true)) {
                    $data['image'] = $fileUpload->getUploadName();
                } else {
                    $errors['image'] = $fileUpload->getMessage();
                }
                if (empty($errors)) {
                    $data['slug'] = empty($data['slug']) ? make_slug($data['title']) : $data['slug'];
                    if ((new Model)->table('books')->insert($data)) {
                        redirect('books');
                    } else {
                        $errors['error'] = 'something went wrong';
                    }
                }
            }

            if (!empty($errors)) {
                $errors['data'] = $data;
                redirect('books/create', 'errors', serialize($errors));
            }
        } else {
            redirect();
        }
    }

    public function edit($slug)
    {
        if ($data['book'] = (new Model)->table('books')->getWhere('slug', $slug)[0]) {
            $data['users'] = (new UserModel)->getAll();
            $data['cats'] = (new CategoryModel)->getAll();
            return $this->view('admin' . DS . 'books' . DS . 'edit', $data);
        }
        return $this->view('admin' . DS . 'books');
    }

    public function update()
    {
        if (isset($_POST['update_bk']) && isset($_POST['bk_id'])) {

            $data = [
                'title' => trim($_POST['bk_title']),
                'slug' => trim($_POST['bk_slug']),
                'description' => trim($_POST['bk_desc']),
                'pub_status' => $_POST['bk_status'],
                'price' => $_POST['bk_price'],
                'resp_user_id' => $_POST['bk_resp'],
                'category_id' => $_POST['bk_category'],
            ];

            $errors = array();

            if (strlen($data['title']) > 4) {
                if (!(new BookModel)->is_unique_except('title', $data['title'], trim($_POST['old_title']))) {
                    $errors['title'] = 'this title is already taken';
                }
            } else {
                $errors['title'] = 'Title must be mor than 4 characters';
            }

            if (valid_slug($data['slug'])) {
                if (!(new BookModel)->is_unique_except('slug', $data['slug'], trim($_POST['old_slug']))) {
                    $errors['slug'] = 'this slug is already taken';
                }
            } else {
                $errors['slug'] = 'slug must be like example-example-example';
            }

            if (isset($_FILES['bk_image']) && $_FILES['bk_image']['error'] != UPLOAD_ERR_NO_FILE) {
                $fileUpload = new Uploader;
                $fileUpload->setDir(UPLOADS)->setMaxSize(5)->setExtensions(['jpg', 'jpeg', 'png', 'webp']);
                if ($fileUpload->uploadFile('bk_image', true)) {
                    $data['image'] = $fileUpload->getUploadName();
                } else {
                    $errors['image'] = $fileUpload->getMessage();
                }
            }

            if (empty($errors)) {
                if ((new Model)->table('books')->update($data, 'id', $_POST['bk_id'])) {
                    redirect('books');
                } else {
                    $errors['error'] = 'something went wrong';
                }
            }

            if (!empty($errors)) {
                $errors['data'] = $data;
                redirect('books/edit/' . trim($_POST['old_slug']), 'errors', serialize($errors));
            }
        } else {
            redirect();
        }
    }

    public function destroy()
    {
        if (isset($_POST['book_id'])) {
            if ((new BookModel)->delete('id', $_POST['book_id'])) {
                @unlink(UPLOADS . $_POST['book_img']);
                redirect('books');
            } else {
                $errors['error'] = 'something went wrong';
            }
            if (!empty($errors)) {
                redirect('book', 'errors', serialize($errors));
            }
        } else {
            redirect();
        }
    }
}
