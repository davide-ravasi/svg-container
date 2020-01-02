<?php 
   function isInWishlist($wishlist,$postId) {  
       foreach($wishlist as $el) {
           $idComp = $_SESSION['user_id'].'-'.$postId;
           if($el->id == $idComp) {
               return true;
           }
       }        
       return false;
   }