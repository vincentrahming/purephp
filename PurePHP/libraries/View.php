<?php

    /**
     * @name    Framework View Class
     * @author  Vincent Rahming <vincentrahming@gmail.com>
     * @desc    Responsible for booting the application, processing parameters passed by url and invoking the relevant controller, model and view
     * @since   July 9th, 2013
     */
     Class View {
        
         public $pageParams     =   NULL;
         public $message        =   NULL;
         
         public function __construct() {
           //  $this->Cache       =   new Cache();
         }
         
        /**
         * @name display
         * @desc responsible for calling and displaying view
         * @param Sting $page name of page to be displayed
         */
        public function display($page, $parameters = FALSE) {
           
            # determine if file is cached, if cached, use active/good cached copy           
            # if parameter for footer is provided, use it, else use default
            if ( ! empty($parameters) ) :
                
                if ( ! empty( $parameters['header'] ) ) :
                    
                    if ( file_exists( $parameters['header'] ) ) :
                        
                        require $parameters['header'];        
                        
                    else :
                        
                        require DEFAULT_HEADER_PATH;        
                        
                    endif;
                    
                endif;
                
            else :
                
                require DEFAULT_HEADER_PATH;
            
            endif;
            
            # page
            require VIEW_PATH . $page .'.php';
            
            # if parameter for footer is provided, use it, else use default
            if ( ! empty($parameters) ) :
                
                require $parameters['footer'];
                
            else :
                
                require DEFAULT_FOOTER_PATH;
            
            endif;
            
            # if file was not cached, generate cache file form contents in output buffer once file is not on ignore list
           // $this->Cache->generate();
            
        }
        
    }
    
/** 
 * End of View File
 * libraries/View.php
 */ 