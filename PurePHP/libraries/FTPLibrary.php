<?php

    /**
     * @name    Bean Stalk Framework FTP Class
     * @author  Vincent Rahming <vincentrahming@gmail.com>
     * @desc    FTP functions for Bean Stalk Framework
     * @
     */

    class FTPLibrary extends Controller {
        
        public $ftpUser;
        public $ftpPswd;
        public $ftpHost;
        public $ftpPort;
        public $ftpMode;
        public $ftpTimeOut;
        public $ftpSSL;
        
        
        public function __construct() {
            parent::__construct();
            
            # ftp SSL turned off by default
            if ( empty( $this->ftpSSL ) ) :
                $this->ftpSSL = FALSE;
            endif;
            
            # ftp on Port 21 by default
            if ( empty( $this->ftpPort ) ) :
                $this->ftpPort = 21;
            endif;
            
        }
        
        public function connect() {
            
            if ( $this->ftpSSL === FALSE ) :
                
                # connect to ftp without SSL
                $connect        =   ftp_ssl_connect( $this->ftpHost, $this->ftpPort, $this->ftpTimeout );
                
            else: 
                
                $connect        =   ftp_connect( $this->ftpHost, $this->ftpPort, $this->ftpTimeout );
                
            endif;
            
            
            # once connection is established, then login
            try {
            
                $bsfAction          = ftp_login( $connect, $this->ftpUser, $this->ftpPswd );
                
            } catch ( Exception $Exceptions ) {
                
                throw_error( $Exceptions->getMessage() );
                
                # log error in error log file
                
            }
            
        }
        
        public function upload() {
            
        }
        
        public function download() {
            
        }
        
        public function location() {
            
        }
        
        public function disconnect( $connect ) {
            
            ftp_close( $connect );
            
        }
        
    }
    
/** 
 * End of FTPLibrary File
 * libraries/FTPLibrary.php
 */     