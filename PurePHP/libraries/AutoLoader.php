<?php

    
    class AutoLoader {
        
        public static function load_library($classname) {
            require $classname . '.php';
        }
    
    }

    spl_autoload_register(array('AutoLoader', 'load_library'));
    
?>