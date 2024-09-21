<?php

function lc_autoload($classPath)
{
    // 
    $namespacePath = explode('\\', $classPath);

    // Check if namespace is aster or not.
    if ($namespacePath[0] == 'LC') {
        // Get Class Name from end array.
        $className = end($namespacePath);

        // Prepere the path of class file.
        $filePath = get_template_directory() .'/app/config/'. $className . '.php';
        $fileBootstrap = get_template_directory() .'/app/bootstrap/'. $className . '.php';
        $wpWidgets = get_template_directory() . DS . 'includes' . DS . 'widgets' . DS . $className . '.php';

        if (file_exists($filePath)) {
            require_once($filePath);
        } elseif (file_exists($fileBootstrap)) {
            require_once $fileBootstrap;
        } elseif(file_exists($wpWidgets)) {
            require_once $wpWidgets;
        }
    }

}

spl_autoload_register('lc_autoload');