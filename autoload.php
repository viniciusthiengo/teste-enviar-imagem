<?php
    spl_autoload_register(function ($class) {
        $paths = array(
            './apl/',
            '../apl/',
            './domain/',
            '../domain/',
            './cgd/',
            '../cgd/',
            './ctrl/',
            '../ctrl/',
        );

        for($i = 0, $tamI = count($paths); $i < $tamI; $i++){
            if(  file_exists( $paths[$i] . $class . '.php' ) ){
                require_once( $paths[$i] . $class . '.php');
            }
        }
    });
