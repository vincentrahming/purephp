<?php

    /**
     * @name    Framework Database Class
     * @author  Vincent Rahming <vincentrahming@gmail.com>
     * @desc    Responsible for handling mathematical processes for Framework
     * @since   July 9th, 2013
     */

    class Database extends Controller {
        
        public $host;
        public $user;
        public $pass;
        public $source;
        
        public function __construct() {
            parent::__construct();            
        }
        
        /**
         * @name server_connect
         * @desc Makes connection to MySQL database server
         */
        
        protected function server_connect() {
            
            $connect  =   mysqli_connect( $this->host, $this->user, $this->pass, $this->source );
            
            if (!$connect) :

                throw new Exception ('Cannot connect to the MySQL Server : '. mysqli_connect_errno() . ' - '. mysqli_connect_error(), 1);

             else :
                         
                return $connect;

             endif;
            
        }
        
        /**
         * @name process
         * @desc Executes any query that is sent to it
         */
        protected function process( $query, $connect ) {

            // set standard results 
            $execute        =       mysqli_query( $connect, $query );
            $error          =       mysqli_errno( $connect );
            $definition     =       mysqli_error( $connect );
            
            // counts and inserts  
            $count          =       @mysqli_num_rows( $execute );
            $lastID         =       @mysqli_insert_id( $connect );
            
            // package results
            $package        =       array();
            
            try {
                
                if ( $this->error_control( $error, $definition ) ) :
                    
                    array_push( $package, $error );
                    array_push( $package, $count );
                    array_push( $package, $execute );
                    array_push( $package, $definition );
                    array_push( $package, $lastID );

                    return $package;
                    
                endif;
                
            } catch ( Exception $e ) {
                   
                echo $e->getMessage();
                return NULL;
                
            }
            
        }
        
        protected function process_aggregates( $query, $connect ) {

            // set standard results 
            $execute        =       mysqli_query( $connect, $query );
            $error          =       mysqli_errno( $connect );
            $definition     =       mysqli_error( $connect );
            $store          =       @mysqli_fetch_array( $execute );
            
            // package results
            $package        =       array();
            
            try {
                
                if ( $this->error_control( $error, $definition ) ) {
                    
                    array_push( $package, $error );
                    array_push( $package, $store[0] );

                    return $package;
                    
                }
                
            } catch ( Exception $e ) {
                   
                echo $e->getMessage();
                return NULL;
                
            }
            
        }
        
        /**
         * @name error_control
         * @desc determines if an error exists and throws appropriat exception
         */
        protected function error_control ( $error, $definition ) {

            if ($error != 0) :

                // if query error equal to zero, display mysql error
                throw new Exception ('MySQLI Error: '. $error .' - '. $definition, 0);
                
            else :
                
                return TRUE;
                
            endif;

        }

        /**
         * @name sql
         * @desc Allows a free form user-defined query to be entered executed
         * @return array $output;
         */
        public function sql( $query) {
                  
            try {

                # connect to server
                $connect    =   $this->server_connect();
               
            } catch ( Exception $e ) {
                        
                echo $e->getMessage();

            }

            # process mysql query
            $statement      =       $this->process( $query, $connect );
    
            # get results and dump into an array for output;
            $result_records =	array();
            $output         =	array();

            if ( !is_null( $statement ) ) :
            
                while ( $records	= mysqli_fetch_array( $statement[2] ) ) :

                    array_push( $result_records, $records );

                endwhile;

                # setup results for output
                array_push( $output, $statement[0] );
                array_push( $output, $statement[1] );
                array_push( $output, $result_records );
                
            endif;
            
            # close database connection
            $this->disconnect( $connect );

            # return output
            return $output;
                    		
        }
        
        /**
         * @name insert_data
         * @desc Allows an insetion of data into a selected table
         * @param string database
         * @param string table
         * @param string fields
         * @param string values
         * @param string flags  optional values 'IGNORE or DELAYED'
         * @return mixed $output returns error code and last inserted ID;
         */
        
        public function insert_data ( $table, $fields, $values, $flags = NULL ) {
         
            try {

                # connect to server
                $connect    =   $this->server_connect();
                        
            } catch ( Exception $e ) {
                        
                echo $e->getMessage();

            }
            
            # process the mysql insert statement
            $query         =	'INSERT '. $flags . ' INTO '. $database .'.'.$table .' ('. $fields .') VALUES ('. $values .')';
            $statement     =   $this->process( $query, $connect );
             
            # package for output
            $output        =   array();
             
            array_push( $output, $statement[0] );
            array_push( $output, $statement[4] );
             
            # close database connection
            $this->disconnect( $connect );
            
            # return output
            return $output;
            
        }
        
        /**
         * @name update_data
         * @desc Allows a free form user-defined query to be entered executed
         * @param string database
         * @param string table
         * @param string fields
         * @param string conditions
         * @param string flags  optional values 'IGNORE'
         * @return mixed $output returns error code and last inserted ID;
         */

        public function update_data( $table, $fields, $conditions, $flags = NULL) {
        
            try {

                # connect to server
                $connect    =   $this->server_connect();
                        
            } catch ( Exception $e ) {
                        
                echo $e->getMessage();

            }
            
            # process the mysql update statement
            $query	=	'UPDATE '. $flags .' '.$database .'.'.$table .' SET '. $fields .' '. $conditions;
            $statement  =       $this->process( $query, $connect );

            $output     =       array();
            
            # package for output
            array_push( $output, $statement[0] );
            
            # disconnect from server
            $this->disconnect( $connect );
            
            # return $output;
            return $output;
            
        }
        
        /**
         * @name delete_data
         * @desc Allows a free form user-defined query to be entered executed
         * @param string database
         * @param string table
         * @param string conditions
         * 
         * @return mixed $output returns error code and rows affected;
         */

        public function delete_data( $table, $conditions ) {
        
            try {

                # connect to server
                $connect    =   $this->server_connect();
                        
            } catch ( Exception $e ) {
                        
                echo $e->getMessage();

            }
            
            # process the mysql delete statement
            $query	=	'DELETE FROM '.$database .'.'.$table .' '. $conditions;
            $statement  =       $this->process( $query, $connect );

            $output     =       array();
            
            # package for output
            array_push( $output, $statement[0] );

            # disconnect from server
            $this->disconnect( $connect );
            
            # return 
            return $output;
            
        }
        
        /**
         * @name total_count
         * @desc Allows for a count of specified field
         * @param string database
         * @param string table
         * @param string field
         * @param string conditions
         * @param string flags
         * 
         * @return mixed $output returns error code and rows affected;
         */
	public function total_count( $table, $field, $conditions ) {
        
            try {

                # connect to server
                $connect    =   $this->server_connect();
                        
                        
            } catch ( Exception $e ) {
                        
                echo $e->getMessage();

            }
            
            # process the mysql delete statement
            $query	=	'SELECT COUNT('. $field .') as total_count FROM '.$database .'.'.$table .' '. $conditions;
            $statement  =       $this->process_aggregates( $query, $connect );

            $output     =       array();
           
            # package for output
            array_push( $output, $statement[0] );
            array_push( $output, $statement[1] );
            
            # disconnect from server
            $this->disconnect( $connect );
            
            # return 
            return $output;
            
        }
        
        /**
         * @name total_sum
         * @desc Allows for a sum total of specified field
         * @param string database
         * @param string table
         * @param string field
         * @param string conditions
         * @param string flags
         * 
         * @return mixed $output returns error code and rows affected;
         */
	public function total_sum( $table, $field, $conditions ) {
        
            try {

                # connect to server
                $connect    =   $this->server_connect();
                        
            } catch ( Exception $e ) {
                        
                echo $e->getMessage();

            }
            
            # process the mysql delete statement
            $query	=	'SELECT SUM('. $field .') as total_count FROM '.$database .'.'.$table .' '. $conditions;
            $statement  =       $this->process_aggregates( $query, $connect );

            $output     =       array();
            
            # package for output
            array_push( $output, $statement[0] );
            array_push( $output, $statement[1] );
            
            # disconnect from server
            $this->disconnect( $connect );
            
            # return 
            return $output;
            
        }
        
        /**
         * @name total_average
         * @desc Allows for a average of total of specified field
         * @param string database
         * @param string table
         * @param string field
         * @param string conditions
         * @param string flags
         * 
         * @return mixed $output returns error code and rows affected;
         */
	public function total_average( $database, $table, $field, $conditions ) {
        
            try {

                # connect to server
                $connect    =   $this->server_connect();
                        
            } catch ( Exception $e ) {
                        
                echo $e->getMessage();

            }
            
            # process the mysql delete statement
            $query	=	'SELECT AVG('. $field .') as total_count FROM '.$database .'.'.$table .' '. $conditions;
            $statement  =       $this->process_aggregates( $query, $connect );

            $output     =       array();
            
            # package for output
            array_push( $output, $statement[0] );
            array_push( $output, $statement[1] );
            
            # disconnect from server
            $this->disconnect( $connect );
            
            # return 
            return $output;
            
        }
        
        /**
         * @name max_value
         * @desc Allows for a max value in a specified column
         * @param string database
         * @param string table
         * @param string field
         * @param string conditions
         * @param string flags
         * 
         * @return mixed $output returns error code and rows affected;
         */
	public function max_value( $database, $table, $field, $conditions ) {
        
            try {

                // connect to server
                $connect    =   $this->server_connect();
                        
            } catch ( Exception $e ) {
                        
                echo $e->getMessage();

            }
            
            # process the mysql delete statement
            $query	=	'SELECT MAX('. $field .') as total_count FROM '.$database .'.'.$table .' '. $conditions;
            $statement  =       $this->process_aggregates( $query, $connect );

            $output     =       array();
            
            # package for output
            array_push( $output, $statement[0] );
            array_push( $output, $statement[1] );
            
            # disconnect from server
            $this->disconnect( $connect );
            
            # return 
            return $output;
            
        }
        
        /**
         * @name min_value
         * @desc Allows for a max value in a specified column
         * @param string database
         * @param string table
         * @param string field
         * @param string conditions
         * @param string flags
         * 
         * @return mixed $output returns error code and rows affected;
         */
	public function min_value( $database, $table, $field, $conditions ) {
        
            try {

                # connect to server
                $connect    =   $this->server_connect();
                        
            } catch ( Exception $e ) {
                        
                echo $e->getMessage();

            }
            
            # process the mysql delete statement
            $query	=	'SELECT MIN('. $field .') as total_count FROM '.$database .'.'.$table .' '. $conditions;
            $statement  =       $this->process_aggregates( $query, $connect );

            $output     =       array();
            
            # package for output
            array_push( $output, $statement[0] );
            array_push( $output, $statement[1] );
            
            # disconnect from server
            $this->disconnect( $connect );
            
            # return 
            return $output;
            
        }
        
        /**
         * @name disconnect
         * @desc kills MySQL Thread
         * @param resource $connect 
         * 
         * @return NULL;
         */
        protected function disconnect( $connect ) {
            mysqli_close( $connect );
        }
            	
    }

/** 
 * End of Database File
 * libraries/Database.php
 */ 