<?php

    class Config {
        
       /**
        * @name    PurePHP Framework Configuration Class
        * @author  Vincent Rahming <vincentrahming@gmail.com>
        * @desc    Establishes and holds configuration values for PurePHP Framework
        * @since   May 9th, 2017
        */
        
        public function __construct() {
     
            # System Error Reporting Controls
            error_reporting(E_ALL & ~E_NOTICE|E_STRICT);
            ini_set('display_errors', 1);
            
            define( '_URL_PATH', 'http://localhost/PurePHP/' );                                          
            define( 'BASE_PATH', realpath('') .'/' );                # base (absolute) file path     
            define( 'CTRL_PATH', 'controllers/' );                   # path for custom controllers
            define( 'LIBS_PATH', 'libraries/' );                     # path for application libraries / helpers    
            define( 'MODS_PATH', 'models/' );                        # path for application models            
            define( 'VIEW_PATH', 'views/' );                         # path for view pages
            define( 'LOGIN_PATH', 'login/' );                        # determines location of login page
            define( 'PUBLIC_PATH', 'public/' );                      # path to public folder
            
            # public paths (includes images, javascript, css and other scripts)
            define( 'IMGS_PATH', PUBLIC_PATH . 'images/');           # path for images 
            define( 'JAVA_PATH', PUBLIC_PATH . 'java/');             # path for java script library files
            define( 'CSS_PATH',  PUBLIC_PATH . 'css/');              # path for css style sheets
            define( 'LOGS_PATH', PUBLIC_PATH . 'logs/');             # path for logs to be written
            
            define( 'UPLD_PATH', PUBLIC_PATH . 'uploads/' );         # upload folder for items that are uploaded to server
            define( 'DWLD_PATH', PUBLIC_PATH . 'downloads/' );       # downloads folder for items that will be downloaded
            
            # public paths for views
            define( 'DEFAULT_HEADER_PATH', VIEW_PATH . 'header.php');
            define( 'DEFAULT_FOOTER_PATH', VIEW_PATH . 'footer.php');
            
            # define paths to other classes within the project scope
            set_include_path( get_include_path() . PATH_SEPARATOR . BASE_PATH . CTRL_PATH );
            set_include_path( get_include_path() . PATH_SEPARATOR . BASE_PATH . MODS_PATH );
            set_include_path( get_include_path() . PATH_SEPARATOR . BASE_PATH . LIBS_PATH );
            
            # DATABASE CONFIGURATION
            define( 'DB_HOST', 'localhost' );                        # database Host Server Address            
            define( 'DB_NAME',   'MVPSource');                       # primary database on server            
            define( 'DB_PREFIX', 'clapboa1_');                       # prefix name for shared hosting            
            define( 'DB_USER',   'root');                            # user name for databse server connection            
            define( 'DB_PASS',   'root');                            # password for database servce connection            
            define( 'DB_DRIVER', '');                                # defines type of database connection MYSQL by default                        
       
            # MAIL CONFIGURATION
            define( 'SMTP_HOST',  '' );                             # 
            define( 'SMTP_USER',  '' );                             #     
            define( 'SMTP_PASS',  '' );                             #
            define( 'SMTP_IPORT', '' );                             #
            define( 'SMTP_OPORT', '' );                             #
            
            # CACHE CONFIGURATION
            define('CACHE_PATH', 'cache/' );                        # protected path cache folder
            define('CACHE_TTL', 86400 );                            # time to live value (24 hours or (60 * 60 * 24))
            define('CACHE_EXT', 'cache' );                          # extension to give cached files
            
            # TIMEZONE CONFIGURATION
            date_default_timezone_set('America/Nassau');
            
            # GENERAL CONFIGURATION
            define('APP_TITLE', '');
     
            # timeout value in minutes
            define('TIMEOUT', '15');                                # amount of time allowed for inactivity before 
     
            # require class auto loader
            require_once LIBS_PATH . 'AutoLoader.php';
            
        }
        
    }

/** 
 * End of Config File
 * libraries/Config.php
 */ 