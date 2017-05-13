<?php

    class Error extends Controller {

        public function __construct() {            
            parent::__construct();            
        }
    
        public function index() {            
            $this->view->display( 'Error' );            
        }
        
    }

/** 
 * End of Error - Controller File
 * controllers/index.php
 */ 