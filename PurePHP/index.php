<?php

    /**
     * @name    PurePHP Framework
     * @author  Vincent J. Rahming
     * @desc    PurePHP Framework designed on MVC architecture
     * @since   May 9th, 2017   
     */
 
     # require configuration file
     require_once 'libraries/Config.php';
     new Config();    
     
     # initiate bootstrap file
     $objBootstrap = new Bootstrap();
     $objBootstrap->initialize();
            