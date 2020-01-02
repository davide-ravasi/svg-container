<?php
    session_start();
// flash msg helper
// example - flash('register_success','you are now registered');
// Display in view - echo flash('register_success');
function flash($name = '', $message = '', $class = 'alert alert-success') {
    if(!empty($name)) {
        // to register session for message
        if(!empty($message) && empty($_SESSION[$name])) {
            
            if(!empty($_SESSION[$name])) {
                unset($_SESSION[$name]);
            }
            
            if(!empty($_SESSION[$name.'_class'])) {
                unset($_SESSION[$name.'_class']);
            }
            
            $_SESSION[$name] = $message;
            $_SESSION[$name.'_class'] = $class;
        } elseif(empty($message) && !empty($_SESSION[$name])) {
            // to activate box message alert
            $class = !empty($_SESSION[$name.'_class']) ? $_SESSION[$name.'_class'] : '';
            echo '<div class="'.$class.'" id="msg-flash">'.$_SESSION[$name].'</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name.'_class']);
        }
        
    }
}
function isLoggedIn() {
    if(isset($_SESSION['user_id'])) {
        return true;
    } else {
        return false;
    }
}

function isAdmin() {
    if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
        return true;
    } else {
        return false;
    }
}