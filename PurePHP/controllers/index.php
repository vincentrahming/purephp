<?php

     class Index extends Controller {

     public function __construct() {
            
            parent::__construct();
            $this->modelname            =   'Mod'. __CLASS__;
            $this->view->modIndex       =   new $this->modelname;              
            
        }

        public function index() {
            
            $this->view->display( 'Index' );
           
        }

    }

/** 
 * @name    Index - Controller File
 * @author  Vincent J Rahming <vincentrahming@gmail.com>
 * @file    controllers/index.php
 * @project 
 */     