<?php
            
use GrudTeste\custom\controller\MainIndex;

define("DB_INI", "../grud_teste_db.ini");
define("API_INI", "../grud_teste_api_rest.ini");
             
function autoload($classe) {

    $prefix = 'GrudTeste';
    $base_dir = 'GrudTeste';
    $len = strlen($prefix);
    if (strncmp($prefix, $classe, $len) !== 0) {
        return;
    }
    $relative_class = substr($classe, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) {
        require $file;
    }

}
spl_autoload_register('autoload');

$controller = new MainIndex();
$controller->main();

       
?>