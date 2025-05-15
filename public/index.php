<?php

session_start();

define('DS', DIRECTORY_SEPARATOR);
define('PATH_PUBLIC', __DIR__ . DS);
define('PATH_ROOT', dirname(__DIR__) . DS);
define('PATH_APP', PATH_ROOT . 'App' . DS);

include PATH_APP . 'config/autoload_register.php';

use App\Helper\ConfigHelper;
use Core\Controller\AppController;
use Core\Env\DotEnv;

try {

    $dotenv = new DotEnv(PATH_ROOT . '.env');
    include PATH_APP . 'config/constant.php';

    $app = new AppController();
    $app->run();

} catch (\Exception $e) {
    echo $e->getMessage();
}

