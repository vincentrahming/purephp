<?php

    /**
     * @name    Bean Stalk Framework Model Class
     * @author  Vincent Rahming <vincentrahming@gmail.com>
     * @desc    Instantiating / Access to Models in Bean Stalk Framework
     */

    Class Model {
        
        public function __construct() {
           
            /** 
             * The autoloader has alreadly located and loaded all the Class files. 
             * This file creates a single instance of these objects for the purpose
             * of usage with this framework.             
             */
            
            # establish database object 
            $this->ppObjData            =   new Database();
            
            # submit database parameters for connectivity
            $this->ppObjData->host      =   DB_HOST; 
            $this->ppObjData->user      =   DB_USER; 
            $this->ppObjData->pass      =   DB_PASS; 
            $this->ppObjData->source    =   DB_NAME; 
            
            # Default Mail SMTP Settings
            # These settings will be used unless otherwise overwritten in the application
            $this->ppObjMail            =   new PHPMailer();
            
            $this->ppObjMail->IsSMTP();
            $this->ppObjMail->SMTPAuth  =   true;           
            
            $this->ppObjMail->Host      =   '';
            $this->ppObjMail->Port      =   25;
            $this->ppObjMail->Username  =   '';
            $this->ppObjMail->Password  =   '';
            
            # active HTML in email
            $this->ppObjMail->isHTML(TRUE); 
            
            # establish system objects (from libraries)
            $this->ppObjTime            =   new TimeLibrary();            
            $this->ppObjImage           =   new ImageLibrary();
            $this->ppObjChart           =   new ChartLibrary();
            $this->ppObjMath            =   new MathLibrary();
            $this->ppObjSys             =   new SystemLibrary();            
            $this->ppObjFTP             =   new FTPLibrary();            
            
        }
        
    }
    
/** 
 * End of Model File
 * libraries/Model.php
 */      