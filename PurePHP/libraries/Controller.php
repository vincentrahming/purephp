<?php

    /**
     * @name    Framework Controller Class
     * @author  Vincent Rahming <vincentrahming@gmail.com>
     * @desc    Responsible for connecting all Models to all Views in Framework
     */
    Class Controller {
        
        private $_fullModelPath     =   null;
        private $_fullModelName     =   null;
        
        public function __construct() {
            
            # manage session
            Session::manager();
            
            # all views must be accessed from the controller
            $this->view     =   new View();            
           
        }
        
       /**
        * @param string $name Name of the model
        */
        public function dispatch($callModel) {
        
            $this->_fullModelName       =   'Mod'. $callModel;
            $this->_fullModelPath       =   MODS_PATH . $this->_fullModelName .'.php';
            
            if ( file_exists( $this->_fullModelPath ) ) :
                
                require_once $this->_fullModelPath;
                $this->model         =   new $this->_fullModelName();
                
            endif;        
            
        }
       
        /**
         * @name Logout
         * @desc destroys session and redirects browser to home page
         */
        public function logout() {
            
            Session::initialize();
            Session::destroy();
            header( 'Location: '. _URL_PATH );
            
        }
        
    }

/** 
 * End of Controller File
 * libraries/Controller.php
 */ 
