<?php

    /**
     * @name    Framework Session Class
     * @author  Vincent Rahming <vincentrahming@gmail.com>
     * @desc    Responsible for handling session data for Framework
     * @since   July 9th, 2013
     */
    class Session {
    
        /**
         * @name Initalize
         * @desc Invokes Session
         */
        public static function initialize() {
            @session_start();
        }
    
        /**
         * @name Set
         * @desc Creates a session variable that can contain a Mixed Value
         * @param STRING $key
         * @param MIXED $value
         */
        public static function set( $key, $value ) {
            
            $_SESSION[ $key ] = $value;
            
        }
    
        /**
         * @name Get
         * @desc Gets the value of a Session variable
         * @param type $key
         * @return MIXED SessionParam
         */
        public static function get($key) {
            
            if ( isset( $_SESSION[ $key ] ) ) :
            
                return $_SESSION[ $key ];
            
            endif;
            
        }
        
        /**
         * @name Stop
         * @desc Destroys a Session variable with matching $key
         * @param MIXED $key
         */
        public static function stop( $key ) {
            
            if ( isset( $_SESSION[$key] ) ) :
                unset( $_SESSION[ $key ] );
            
            endif;
            
        }  
    
        /**
         * @name Destroy
         * @desc Destorys entire session.  Clears all session values;
         */
        public static function destroy() {
            
            session_destroy();
            
        }
        
        /**
         * @name Refresh
         * @desc Determines amount of time before page will be refreshed. Used for the purpose of automatic logout
         */
        public static function refresh() {
            
            if ( self::get( 'isLoggedIn' ) == 1 ) :
                
                return '<meta http-equiv="Refresh" content="'. (TIMEOUT * 60).'; url='. _URL_PATH .'" />';
                
            endif;
            
        }
        
        public static function isAllowed() {
            
            self::initialize();
            
            # determine if session is active
            if ((self::get('isLoggedIn') == 1) AND (self::get('sUserRole') == ADMIN_LEVEL)):
                
                return TRUE;
            
            else:
            
                View::display('error/restricted');
                
            endif;
            
        }
        
        /**
         * @name manager
         * @desc Manages session once it is active. 
         * 
         */
        public static function manager() {
            
            # initialize session
            self::initialize();
            
            # if not logged, do not process 
            if (self::get('isLoggedIn') == FALSE) :
            
                if (!self::get('sessFailCheck')) :
                    
                    # set sessFailCheck to TRUE
                    # this stops a continuous redirect
                    self::set('sessFailCheck', TRUE);
                    
                    # redirect to home page
                    header('Location: '. _URL_PATH );
                
                endif;
            
            endif;
            
            # determine if session start variable exists and contains value
            if (((!self::get('sessStarted'))) || (self::get('sessStarted') == '')) :
                
                # start SessionStarted and pass latest time value
                self::set('sessStarted', time());
                
            endif;
            
            # if timeout if greater than session, kill the session else reset the timeout 
            if ((time() - self::get('sessStarted')) > (TIMEOUT * 60)) :  # timeout value in minutes
            
                self::destroy();
                
                # redirect to home page
                header('Location: '. _URL_PATH);
            
            else:
                
                # reset time value
                self::set('sessStarted', time());
                
            endif;
            
        }
    
    }
    
/** 
 * End of Session File
 * libraries/Session.php
 */ 