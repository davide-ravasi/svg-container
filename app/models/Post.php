<?php
 class Post {
     private $db;
     
     public function __construct() {
         $this->db = new Database;
     }
     
     public function getPosts() {
         $this->db->query('SELECT * ,
                            users.name as userName,
                            posts.created_at as postCreated,
                            users.created_at as userCreated,
                            posts.id as postId,
                            categories.name as cat_name
                            FROM posts 
                            INNER JOIN users 
                            ON posts.user_id = users.id
                            INNER JOIN categories
                            ON posts.id_cat = categories.id
                            ORDER BY posts.created_at DESC');
         
         return $this->db->resultSet();
     }
     
     public function add($data) {
         
         $this->db->query('INSERT INTO posts (user_id, title, body, image_url,id_cat)
                            VALUES (:user_id,:title,:body,:image_url,:id_cat)');
         
         $this->db->bind(':user_id',$data['user_id']);
         $this->db->bind(':title',$data['title']);
         $this->db->bind(':body',$data['body']);
         $this->db->bind(':image_url',$data['image_url']);
         $this->db->bind(':id_cat',$data['id_cat']);
         
               // Execute
          if($this->db->execute()){
            return true;
          } else {
            return false;
          }
     }
     
     public function edit($data) {
         $this->db->query('UPDATE posts 
                            SET title = :title, 
                                body = :body, 
                                user_id = :user_id,
                                image_url = :image_url,
                                id_cat = :id_cat
                            WHERE id = :id');
         
         $this->db->bind(':user_id',$data['user_id']);
         $this->db->bind('title',$data['title']);
         $this->db->bind(':body',$data['body']);
         $this->db->bind(':id',$data['post_id']);
         $this->db->bind(':image_url',$data['image_url']);
         $this->db->bind(':id_cat',$data['id_cat']);
         
          // Execute
          if($this->db->execute()){
            return true;
          } else {
            return false;
          }         
     }
     
     public function getPostById($id) {
         $this->db->query('SELECT * FROM posts WHERE id = :id');
         
         $this->db->bind(':id',$id);
         
         $row =  $this->db->single();
         
         return $row;
     }
     
     public function delete($id) {
         $this->db->query("DELETE FROM posts
                            WHERE id = :id");
         
         $this->db->bind(':id',$id);
         
         if($this->db->execute()) {
             return true;
         } else {
             return false;
         }
     }
     
     public function addToWishlist($id) {
         $this->db->query("INSERT INTO wishlist (id,id_user,id_svg) VALUES (:id,:id_user, :id_svg)");
         
         $this->db->bind(':id',$_SESSION['user_id'].'-'.$id);
         $this->db->bind(':id_user',$_SESSION['user_id']);
         $this->db->bind(':id_svg',$id);

         if($this->db->execute()) {
             //var_dump('addwishlist model2');die;
             return true;
         } else {
             //var_dump('addwishlist model3');die;
             return false;
         }
     }
     
     public function removeFromWishlist($id) {
         $this->db->query("DELETE FROM wishlist
                            WHERE id = :id");
         
         $this->db->bind(':id',$_SESSION['user_id'].'-'.$id);
         
         if($this->db->execute()) {
             return true;
         } else {
             return false;
         }        
     }
 }