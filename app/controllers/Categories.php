<?php
class Categories extends Controller {
    private $viewModel;
    private $userModel;
    
    public function __construct() {
        if(!isLoggedIn() or (isLoggedIn() and !isAdmin())) {
            redirect("users/login");
        }
        
        $this->viewModel = $this->model('Categorie');
        $this->userModel = $this->model('User');
    }   
    
    public function index() {
        $data['categories'] = $this->viewModel->getCategories();
        
        $this->view("categories/index",$data);
        
    }
    
    public function add() {
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'name' => trim($_POST['name'])
            ];
            
            if(empty($data['name'])) {
                $data['name_err'] = 'insert the name of the categorie';
            }
            
            if(empty($data['name_err'])) {
                if($this->viewModel->add($data)) {
                    flash('categorie_added','categorie added :)');
                    redirect('categories');die;
                }
            } else {
                $data = [
                    'name' => ''
                ];
                
                $this->view('categories/add',$data);
            }
        } else {
            $data = [
                'name' => ''
            ];

            $this->view('categories/add',$data);
        }
    }
    
    public function edit($id) {
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'id' => $id,
                'name' => trim($_POST['name'])
            ];
            
            if(empty($data['name'])) {
                $data['name_err'] = 'insert the name of the categorie';
            }
            
            if(empty($data['name_err'])) {
                if($this->viewModel->edit($data)) {
                    flash('categorie_added','categorie modified :)');
                    redirect('categories');die;
                }
            } else {
                
                $categorie = $this->viewModel->getCategorieById($id);
                
                $data = [
                    'id' => $categorie->id,
                    'name' => $categorie->name
                ];
                
                $this->view('categories/edit',$data);
            }
        } else {
            $categorie = $this->viewModel->getCategorieById($id);

            $data = [
                'id' => $categorie->id,
                'name' => $categorie->name
            ];

            $this->view('categories/edit',$data);
        }
    }
    
    public function delete($id) {
            if($this->viewModel->delete($id)) {
                flash('categorie_added','categorie deleted :)');
                redirect('categories');die;
            }
    }
}    