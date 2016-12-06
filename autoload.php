<?php
function classLoader($class)
{
    $helperPath = __DIR__ . '/src/helpers.php';
    if(file_exists($helperPath)){
        require_once  $helperPath;
    }
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    $path = str_replace('Payment' . DIRECTORY_SEPARATOR, '', $path);
    $file = __DIR__ . '/src/' . $path . '.php';


    if (file_exists($file)) {
        require_once $file;
    }
}
spl_autoload_register('classLoader');