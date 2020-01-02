<?php
    // load config
    require_once 'config/config.php';

    require_once 'helpers/url_helper.php';
    require_once 'helpers/session_helper.php';
    require_once 'helpers/wishlist_helper.php';

    // librairies
    //require_once 'librairies/Controller.php';
    //require_once 'librairies/Core.php';
    //require_once 'librairies/Database.php';
    
    // autoload core librairies
    spl_autoload_register(function($class) {
        include 'librairies/'. $class . '.php';
    });