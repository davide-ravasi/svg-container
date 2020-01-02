<?php
    /*
    * App Core Class
    * Creates URL & loads core controller
    * URL FORMAT - /controller/method/params
    */

    class Core {
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];
        
        public function __construct() {
            //print_r($this->getUrl());
            $url = $this->getUrl();
            
            //look in controllers for first value
            // UCWORDS() : convert the first character of each word to uppercase
            if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')) {
                $this->currentController = ucwords($url[0]);
                //echo $this->currentController;
                //unset 0 index
                unset($url[0]);
            }
         
            // require the controller
            require_once '../app/controllers/'. $this->currentController . '.php';
            
            // instantiate controller class
            $this->currentController = new $this->currentController;
            
            
            //check for second part of the url
            if(isset($url[1])) {
                //check to see if method exists in controller
                if(method_exists($this->currentController, $url[1])) {
                    // if this method exists
                    $this->currentMethod = $url[1];
                    
                    // unset 1 index
                    unset($url[1]);
                }
            }
            // con unset permette ora di prendere tutti i parametri di url 
            // e usarli a parte
            // Get params
            $this->params = $url ? array_values($url) : [];

            // Call a callback with array of params
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
            
        }
        public function getUrl() {
            if(isset($_GET['url'])) {
                $url = rtrim($_GET['url'], '/'); //trimma gli spazi alla fine e lo slash se c'è
                $url = filter_var($url, FILTER_SANITIZE_URL); // elimina i caratteri illegali dall'url
                $url = explode('/', $url);
                return $url;
            };
        }
    }