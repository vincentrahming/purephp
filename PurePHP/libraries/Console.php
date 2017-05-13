<?php


    /**
     * @name    Framework Console Class
     * @author  Vincent Rahming <vincentrahming@gmail.com>
     * @desc    Responsible for handling mathematical processes for Framework
     * @since   September 15th, 2014
     */

    class Console extends Controller {
        
        public function __construct() {
            
            parent::__construct();
            
            # set log path
            $this->logPath      =   BASE_PATH . LOGS_PATH;
            $this->logParent    =   BASE_PATH . PUBLIC_PATH; 
            $this->logDefault   =   $this->logPath . date('Ymd') .'.txt';
            
            # sure that log path exists
            if ( $this->_checkLogPath( $this->logPath ) === FALSE ) :
                
                
            endif;
            
        }
        
        private function _checkLogPath( $LogPath ) {

            if ( !file_exists( $LogPath ) ) :
                
                # create file path;
                return $this->_createLogPath( $LogPath );
            
            endif;

        }
        
        private function _createLogPath( $LogPath ) {
            
            # if the file path is writeable,
            if ( is_writable(  $this->logParent ) ) :
                
                mkdir( $LogPath, 0777 );
                $setHandle   =   fopen( $LogPath . 'index.php', 'w+' );
                
                fwrite( $setHandle, '<?php'."\r\r" );
                fwrite( $setHandle, "\t\t". "# redirect url to homepage ..." . "\r" );
                fwrite( $setHandle, "\t\t". "header('Location: ". _URL_PATH ."'); \r\r" );
                fwrite( $setHandle, '?>'. "\r" );
                
                fclose( $setHandle );
            
            else :
                
                return FALSE;
                
            endif;
            
        }
        
        public function createLogFile() {
            
            return  fopen( $this->logDefault , 'a+' );
            
        }
        
        public function writeToLogFile( $LineData ) {
            
            $setHandle  =   $this->createLogFile();
            fwrite( $setHandle, $LineData );
            $this->closeLogFile( $setHandle );
            
        }
        
        public function closeLogFile( &$setHandle ) {
            
            fclose( $setHandle );
            
        }
        
    }
    
?>
