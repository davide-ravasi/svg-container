<?php
  class Pages extends Controller {
     /*private $viewModel;
     private $userModel;
      
     public function __construct(){        
         $this->viewModel = $this->model('Pages');  
         //$this->userModel = $this->model('Users');  
    } */

    //public function index(){ 
      /*if(isLoggedIn()) {
          redirect('posts/');
      } */ 
             
     /* $data = [
          'title'=>'SharePosts',
          'description'=>'Simple social network built on Traversy MCV',
          'posts' => $this->viewModel->getPosts()
      ];  
      $this->view('pages/index', $data);
    }*/
    private $viewModel;
    private $catModel;
    private $userModel;
    private $postModel;  
    
    public function __construct() {
        
        $this->viewModel = $this->model('Page');
        $this->postModel = $this->model('Post');
        $this->catModel = $this->model('Categorie');
        $this->userModel = $this->model('User');
    }   
    
    public function index($name = null) {
        //$data['posts'] = $this->viewModel->getPosts();

        $data = [
          'title'=>'SVG Database',
          'description'=>'A collection of usefuls and beautifuls SVG',
          'categories' => $this->catModel->getCategories(),  
          'posts' => $this->viewModel->getPosts(),
          'lastPosts' => $this->viewModel->getLastPosts(),
          'wishlist' => $this->viewModel->getWishlist(),
          'catPosts' => $this->viewModel->getCatPost($name),  
          'name' => $name  
        ];
        
        $this->view("pages/index",$data);
        
    }
      
    public function show($id) {
        
        $post = $this->postModel->getPostById($id);
        $category = $this->catModel->getCategorieById($post->id_cat);
        $user = $this->userModel->getUserById($post->user_id);
        $posts = $this->viewModel->getPosts();
        $wishlist =  $this->viewModel->getWishlist() ;
        
        $data = [
            'post' => $post,
            'category' => $category,
            'user' => $user,
            'posts' => $posts,
            'wishlist' => $wishlist
        ];
        
        $this->view("pages/show",$data);
    }  

    public function about(){
        
        $data = [
            'title' => 'About Us',
            'description'=> 'App to share posts with other users'
        ];
        
        $this->view('pages/about', $data);
    }
      
    public function wishlist(){
        
        if(!isLoggedIn()) {
            redirect('pages/index');
        }
        
        $data = [
            'title' => 'Wishlist\'s svg',
            'description'=> 'Your favorites svg',
            'posts' => $this->viewModel->getPosts(),
            'wishlist' => $this->viewModel->getWishlist() 
        ];
        
        $this->view('pages/wishlist', $data);
    }  
    
    public function category($name) {
        
         $data = [
            'title' => 'Svg in '. $name,
            'description'=> 'Your favorites svg',
            'posts' => $this->viewModel->getPosts(),
            'wishlist' => $this->viewModel->getWishlist(),
            //'category' => $this->catModel->getCategorieByName($name)
             'category' => $name
        ];
        
        $this->view('pages/category', $data);
        
    }  
      
    public function search() {
        
        $data = [
            'title' => 'Results for '. $_POST['search'],
            'description' => 'Matched text in SVG name and category name',
            'key'=> $_POST['search'],
            'posts' => $this->viewModel->getPostsFromSearch($_POST['search']),
            'wishlist' => $this->viewModel->getWishlist()
        ];

        $this->view('pages/search', $data);
        
        
    }   
  }