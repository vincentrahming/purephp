<?php

    /**
     * @name    PurePHP Bootstrap Class
     * @author  Vincent Rahming <vincentrahming@gmail.com>
     * @desc    Responsible for booting the application, processing parameters passed by url and invoking the relevant controller, model and view
     * @since   May 9th, 2013
     */

     final class Bootstrap {
         
         private $setURL            =   null;
         private $setController     =   null;
         private $setCtrlName       =   null;
         private $setErrorFile      =   'error.php';
         private $setDefaultPage    =   'index.php';
         
         /**
          * @desc   Initialize Bootstrap Process          
          */         
        public function initialize() {
           
            // Sets the protected $setURL
            $this->_getUrl();

            // Load the default controller if no URL is set
            // eg: Visit http://localhost it loads Default Controller
            if ( empty( $this->setURL[0] ) ) :
                
                $this->getDefaultController();
                return false;
                
            endif;

            $this->setExistingController();
            $this->setControllerMethod();
             
        }
         
         /**
         * @desc Fetches the $_GET from 'url'
         */
        private function _getUrl() {
    
            // raw url as it show in address bar
            $this->setURL    =   isset( $_GET['arguments'] ) ? explode( '/', filter_var( rtrim( $_GET['arguments'], '/' ), FILTER_SANITIZE_URL ) ) : null;
            
        }
        
        /**
         * @name getDefaultController
         * @desc assigns default controller to scope variable setController
         */
        public function getDefaultController() { 
            
            require_once CTRL_PATH . $this->setDefaultPage;
            $this->setController = new Index();
            $this->setController->index();     
            
        }
        
        /**
         * @name setExistingController
         * @desc assigns default controller to scope variable setController
         */
        public function setExistingController() {
          
            if ( file_exists( CTRL_PATH . $this->setURL[0] . '.php' ) ) :
                
                require_once CTRL_PATH . $this->setURL[0] . '.php';
            
                $this->setCtrlName          =   ucwords( $this->setURL[0] );
                $this->setController        =   new $this->setCtrlName;
                $this->setController->dispatch( $this->setCtrlName );
                
            else:
                
                $this->setError();
               
            endif;   
            
        }
        
        /**
         * If a method is passed in the GET url paremter
         * 
         *  http://localhost/controller/method/(param)/(param)/(param)
         *  url[0] = Controller
         *  url[1] = Method
         *  url[2] = Param
         *  url[3] = Param
         *  url[4] = Param
         */
        private function setControllerMethod() {
    
            $length     =   count( $this->setURL );
            
            // Make sure the method we are calling exists            
            if ( $length > 1 ) :
            
                if ( !method_exists( $this->setController, $this->setURL[1] ) ) :
                    
                    $this->setError();
                    
                endif;
                
            endif;
        
            // Determine what to load
            switch ( $length ) :
            
                case 6:
                    //Controller->Method(Param1, Param2, Param3)
                    $this->setController->{ $this->setURL[1] }( $this->setURL[2], $this->setURL[3], $this->setURL[4], $this->setURL[5] );
                    break;
                
                case 5:
                    //Controller->Method(Param1, Param2, Param3)
                    $this->setController->{ $this->setURL[1] }( $this->setURL[2], $this->setURL[3], $this->setURL[4] );
                    break;

                case 4:
                    //Controller->Method(Param1, Param2)
                    $this->setController->{ $this->setURL[1] }( $this->setURL[2], $this->setURL[3] );
                    break;

                case 3:
                    //Controller->Method(Param1, Param2)
                    $this->setController->{ $this->setURL[1] }( $this->setURL[2] );
                    break;

                case 2:
                    //Controller->Method(Param1, Param2)
                    $this->setController->{ $this->setURL[1] }();
                    break;
                    
                default:
                    $this->setController->index();
                    break;
                
            endswitch;
        
        }
    
        /**
         * Display an error page if nothing exists
         * @return boolean
         */
        private function setError() {
            
            require CTRL_PATH . $this->setErrorFile;
            $this->setController = new Error();
            $this->setController->index();
            return FALSE;
            
        }
         
     }

/** 
 * End of Bootstrap File
 * libraries/Bootstrap.php
 */ 