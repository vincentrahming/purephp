<?php

    class SystemLibrary extends Controller {
        
        public function __construct() {
            parent::__construct();
        }
               
        public function setLoginCheck() {
            
            if ( Session::get('isLoggedIn') === TRUE ) :
                
                # do not display this page
                View::render('security/logged-in');
                
            endif;
            
        }
        
        public function setLoginMessage( $msgType, $msgContent ) {
            
            # css styles to be applied
            $StyleNames         =       array ( 1   =>  'login-success-message',  
                                                2   =>  'login-info-message',    
                                                3   =>  'login-warning-message',    
                                                4   =>  'login-error-message',
                                                5   =>  'login-notice-message' 
                                              );
            
            $setOutput          =       '<div id="loginMessage" class="'. $StyleNames[ $msgType ] .'">';
            
            $setOutput         .=       '<div class="loginCloseMessage">';
            $setOutput         .=       '<img id="closeMessage" src="'. _URL_PATH . IMGS_PATH .'system/loginMessageClose.png" />';
            $setOutput         .=       '</div>';
            
            $setOutput         .=       '<div class="loginMessageContent">';
            $setOutput         .=       $msgContent;
            $setOutput         .=       '</div>';
            
            $setOutput         .=       '</div>';
            
            return $setOutput;
            
        }
        
        public function setFreeMessage ( $MsgType, $MsgContent, $Width = FASLE ) {
            
            # css styles to be applied
            $StyleNames         =       array ( 1   =>  'success-message',  
                                                2   =>  'info-message',    
                                                3   =>  'warning-message',    
                                                4   =>  'error-message',
                                                5   =>  'notice-message' 
                                              );
            
            $setOutput          =       '<div class="'. $StyleNames[$MsgType] .'">';          
            $setOutput         .=       '<div style="overflow: auto; width: 95%;">';
            $setOutput         .=       $MsgContent;
            $setOutput         .=       '</div>';
            $setOutput         .=       '</div>';
            
            return $setOutput;
            
        }
        
        public function setMessage ($MsgType, $MsgContent, $Width = FALSE ) {
            
            # css styles to be applied
            $StyleNames         =       array ( 1   =>  'success-message',  
                                                2   =>  'info-message',    
                                                3   =>  'warning-message',    
                                                4   =>  'error-message');
            
            # style icon names
            $StyleIcons         =       array ( 1   =>  'accepted.png',  
                                                2   =>  'questionmark.png',    
                                                3   =>  'warning.png',    
                                                4   =>  'cancel.png');
            
            
            if ( empty( $Width ) ) :
                
                $DivWidth   =   '600';
            
            else :
                
                $DivWidth   =   $Width;
                
            endif;
            
            $setOutput          =       '<div class="'. $StyleNames[$MsgType] .'">';
            $setOutput         .=       '<img style="display: block; float: left; width: 50px;" src="'. _URL_PATH . IMGS_PATH . 'system/'. $StyleIcons[$MsgType] .'" style="border: 0; float: left; margin: 0 10px; " />';

            $setOutput         .=       '<div style="float: left; overflow: auto; width: '. $DivWidth .'px; margin-left: 25px; margin-top: 5px;">';
            $setOutput         .=       $MsgContent;
            $setOutput         .=       '</div>';
            
            $setOutput         .=       '</div>';
            
            return $setOutput;
            
        }
        
    }

/** 
 * End of System - Library File
 * libraries/System.php
 */       