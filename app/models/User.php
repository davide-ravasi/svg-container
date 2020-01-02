<?php
  class User {
    private $db;
    
    public function __construct() {
      $this->db = new Database;
    }
    
    public function checkEmail($email) {
        $query = 'SELECT * FROM users WHERE email = :email';
      
        $this->db->query($query);
        $this->db->bind(':email',$email);
        $row =  $this->db->single();
      
        if($this->db->rowCount() > 0) {
          return true;
        } else {
          return false;
        }
      
    }
    
    public function registerUser($data) {
      $this->db->query('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)');
      // Bind values
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':password', $data['password']);
        
      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
      
    public function login($email,$password) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email',$email);
        $row =  $this->db->single();
        
        if(password_verify( $password , $row->password )) {
            return $row;
        } else {
            return false;
        }
        
    } 
      
      public function getUserById($id) {
          $this->db->query('SELECT * FROM users WHERE id = :id');
          
          $this->db->bind(':id',$id);
          
          $row = $this->db->single();
          
          return $row;
      }
  }