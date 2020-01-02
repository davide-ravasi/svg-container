<?php
class Posts extends Controller {
    private $viewModel;
    private $catModel;
    private $userModel;
    
    public function __construct() {
        if(!isLoggedIn() or (isLoggedIn() and !isAdmin())) {
            redirect("users/login");
        }
        
        $this->viewModel = $this->model('Post');
        $this->catModel = $this->model('Categorie');
        $this->userModel = $this->model('User');
    }   
    
    public function index() {
        $data['posts'] = $this->viewModel->getPosts();
        $this->view("posts/index",$data);
        
    }
    
    public function add() {
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $image = '';
            $imgError = '';
            $uploader   =   new Uploader();
            $uploader->setDir(MAINROOT.'/public/uploads/images/');
            $uploader->setExtensions(array('svg'));  //allowed extensions list//
            $uploader->setMaxSize(.5);                          //set max file size to be allowed in MB//
            if($uploader->uploadFile('file')){   //txtFile is the filebrowse element name // 
                $image  =   $uploader->getUploadName(); //get uploaded file name, renames on upload//
            }else{//upload failed
                $imgError = $uploader->getMessage();
                //$uploader->getMessage(); //get upload error message 
            }
            
            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'image_url' => $image,
                'id_cat' => trim($_POST['category']),
                'user_id' => $_SESSION['user_id']
            ];
            
            if(empty($data['title'])) { $data['title_err'] = 'insert a title for the post';}
            
            if(empty($data['body'])) { $data['body_err'] = 'insert a text for the post';}

            $data['image_err'] = $imgError;
            
            if(empty($data['image_url'])) { 
                $data['image_err'] = 'add an image for the post';
            }
            
            if(empty($data['body_err']) && empty($data['title_err']) && empty($data['image_err'])) {
                
                if( $this->viewModel->add($data) ) {
                    flash('post_added','post added :)');
                    redirect('posts');die;
                } else {
                    $this->view("posts/add",$data);
                }
                
            } else {
                $this->view("posts/add",$data);
            }
        } else {
            $data = [
                'title' => '',
                'body'=> '',
                'image_url' => '',
                'categories' => $this->catModel->getCategories()
            ];

            $this->view("posts/add",$data);     
        }
       
    }
    
    public function show($id) {
        
        $post = $this->viewModel->getPostById($id);
        $category = $this->catModel->getCategorieById($post->id_cat);
        $user = $this->userModel->getUserById($post->user_id);
        
        $data = [
            'post' => $post,
            'category' => $category,
            'user' => $user
        ];
        
        $this->view("posts/show",$data);
    }
    
    public function edit($id) {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $image = '';
            $imgError = '';
            $uploader   =   new Uploader();
            $uploader->setDir(MAINROOT.'/public/uploads/images/');
            $uploader->setExtensions(array('svg'));  //allowed extensions list//
            $uploader->setMaxSize(.5);                          //set max file size to be allowed in MB//

            if($uploader->uploadFile('file')){   //txtFile is the filebrowse element name // 
                $image  =   $uploader->getUploadName(); //get uploaded file name, renames on upload//
            }else{//upload failed
                $imgError = $uploader->getMessage();
                //$uploader->getMessage(); //get upload error message 
            }
            
            $data = [
                'post_id' => $id,
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'image_url' => $image,
                'user_id' => $_SESSION['user_id'],
                'id_cat' => trim($_POST['category'])
            ];
            
            if(empty($data['title'])) { $data['title_err'] = 'insert a title for the post';}
            
            if(empty($data['body'])) { $data['body_err'] = 'insert a text for the post';}
            
            $data['image_err'] = $imgError;
            
            if(empty($data['body_err']) && empty($data['title_err']) && empty($data['image_err'])) {
                
                if( $this->viewModel->edit($data) ) {
                    flash('post_added','post edited :)');
                    redirect('posts');
                } else {
                    die("an error occurred when modified data on post");
                }
                
            } else {
                $this->view("posts/edit",$data);
            }
            
        } else {
            
            $post = $this->viewModel->getPostById($id);
            
            $data = [
                'title' => $post->title,
                'body'=> $post->body,
                'image_url' => $post->image_url,
                'post_id' => $post->id,
                'cat_id' => $post->id_cat,
                'categories' => $this->catModel->getCategories()
            ];
            
            /* if not the owner can't modify */
            if($post->user_id != $_SESSION['user_id']) {
                redirect('posts/');
            }
            
           
            $this->view("posts/edit",$data);     
        }
    }
    
    public function delete($id) {
        if($this->viewModel->delete($id)) {
            flash('post_added','post deleted :)');
            redirect('posts');die;
        }
    }
    
    public function addwishlist($id) {
        if($this->viewModel->addToWishlist($id)) {
            flash('pages_msg','post added to wishlist :)');
            redirect('pages');die;
        } else {
            flash('pages_msg','post not added towishlist :(');
            redirect('pages');die;
        }
    }
    
    public function removewishlist($id) {
        if($this->viewModel->removeFromWishlist($id)) {
            flash('pages_msg','post removed to wishlist :)');
            redirect('pages');die;
        } else {
            flash('pages_msg','post not removed to wishlist :(');
            redirect('pages');die;
        }
    }
    
}