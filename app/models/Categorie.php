<?php
 class Categorie {
     private $db;
     
     public function __construct() {
         $this->db = new Database;
     }
     
     public function getCategories() {
         $this->db->query('SELECT *
                            FROM categories
                            ORDER BY created_at DESC');
         
         return $this->db->resultSet();
     }
     
     public function add($data) {
         $this->db->query('INSERT INTO categories (name) VALUES(:name)');
         
         $this->db->bind(':name',$data['name']);
         
          // Execute
          if($this->db->execute()) {
            return true;
          } else {
            return false;
          }
     }
     
     public function edit($data) {
         $this->db->query('UPDATE categories SET name = :name WHERE id = :id');
         
         $this->db->bind(':id',$data['id']);
         $this->db->bind(':name',$data['name']);
         
          // Execute
          if($this->db->execute()){
            return true;
          } else {
            return false;
          }
     }
     
     public function delete($id) {
         
         $this->db->query('DELETE FROM categories WHERE id = :id');
         
         $this->db->bind(':id',$id);
        
          // Execute
          if($this->db->execute()){
              $this->db->query('UPDATE posts
                            SET id_cat = :id_cat
                            WHERE id_cat = :id');
              $this->db->bind(':id',$id);
              $this->db->bind(':id_cat','9');
              if($this->db->execute()) {
                  return true;
              } else {
                  return false;
              }
            
          } else {
            return false;
          }
     }
     
     public function getCategorieById($id) {
         $this->db->query('SELECT * FROM categories WHERE id = :id');
         
         $this->db->bind(':id',$id);
         
         $row = $this->db->single();
         
         return $row;
     }
     
     public function getCategorieByName($name) {
         $this->db->query('SELECT * FROM categories WHERE name = :name');
         
         $this->db->bind(':name',$name);
         
         $row = $this->db->single();
         
         return $row;
     }
 }