<?php
    class Users extends Controller {
        
        public function __construct() {
            $this->userModel = $this->model('User');
        }
        
        public function register() {
            // cehck for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process FORM
                
                // sanitize all $_POST data once if thieirs all string like
                $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                           
                $data = [
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm_password']),
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ];
 
                if(empty($data['name'])) {
                    $data['name_err'] = 'insert the name';
                }
                
                if(empty($data['email'])) {
                    $data['email_err'] = 'insert the email';
                }
              
                if($this->userModel->checkEmail($data['email'])) {
                  $data['email_err'] = 'email exists';
                }
                
                if(empty($data['password'])) {
                    $data['password_err'] = 'insert the password';
                } else if (strlen($data['password']) < 6) {
                    $data['password_err'] = "Password is too short. At least 6 characters";
                }
                           
                if(empty($data['confirm_password'])) {
                    $data['confirm_password_err'] = 'confirm the password';
                } else if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = "The confirm password is not the same as password";
                }   
              
                if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) ) {
                  
                  $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);;
                    
                  
                  if($this->userModel->registerUser($data)) {
                    flash('register_success','you are now registered');
                    redirect('users/login');     
                  } else {
                    die('hi hi hi ...... something went wrong');
                  }
                 
                } else {
                  $this->view('users/register',$data);
                }
                
            }   else {
                // init data
                $data = [
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ];
              
                // Load view
                $this->view('users/register',$data);
               
            }  
            
        }
        
        public function login() {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                // process form
                $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 
                
                $data = [
                  'email' => trim($_POST['email']),
                  'password' => trim($_POST['password']),
                  'email_err' => '',
                  'password_err' => ''
                ];
              
                if(empty('email')) {
                  $data['email_err'] = 'email can\'t be empty';
                }
            
                if(empty('password')) {
                  $data['password_err'] = 'password can\'t be empty';
                }
              
                if(strlen($data['password'])<6) {
                  $data['password_err'] = 'password has to be at least 6 character';
                }
                
                if($this->userModel->checkEmail($data['email'])) {
                    // user found
                } else {
                    // user not found
                    $data['email_err'] = 'email doesn\'t exists';
                }
              
                if(empty($data['email_err']) && empty($data['password_err'])) {
                  $loggedInUser = $this->userModel->login($data['email'],$data['password']);
                  
                  if($loggedInUser) {
                      // create 
                      $this->createUserSession($loggedInUser);
                  }  else {
                      $data['password_err'] = 'password incorrect';
                      $this->view('users/login',$data);
                  }
                    
                    
                } else {
                  $this->view('users/login',$data);
                }
              
              
            } else {
                // init data
                $data = [
                    'email' => '',
                    'password' => '',
                    'email_err' => '',
                    'password_err' => ''
                ];
            
                // Load view
                $this->view('users/login', $data);
            }
        }
        public function createUserSession($user) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_name'] = $user->name;
            $_SESSION['user_role'] = $user->role;
            
            redirect('pages/index');
        }
        
        public function logout() {
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);
            session_destroy();
            redirect('users/login');
        }
       
    }