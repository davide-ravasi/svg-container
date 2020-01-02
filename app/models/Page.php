<?php
 class Page {
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
                            ORDER BY posts.title ASC');
         
         return $this->db->resultSet();
     }
     
     public function getLastPosts() {
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
                            ORDER BY posts.created_at DESC
                            LIMIT 4');
         
         return $this->db->resultSet();
     }
     
     public function getCatPost($name = '') {
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
                            WHERE categories.name = :name
                            ORDER BY posts.created_at DESC
                            LIMIT 4');
         
         $this->db->bind(':name',$name);
         
         return $this->db->resultSet();         
     }
     
     public function getPostsFromSearch($txt) {
         $this->db->query("SELECT * ,
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
                            WHERE (posts.title LIKE '%".$txt."%' 
                            OR categories.name LIKE '%".$txt."%')
                            ORDER BY posts.created_at DESC");
         
         return $this->db->resultSet();        
     }
     
     public function getPostById($id) {
         $this->db->query('SELECT * FROM posts WHERE id = :id');
         
         $this->db->bind(':id',$id);
         
         $row =  $this->db->single();
         
         return $row;
     }
     
     public function getWishlist() {
         $this->db->query('SELECT * FROM wishlist');
         
         return $this->db->resultSet();
     }
 }     