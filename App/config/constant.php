<?php

$url = $dotenv->get('BASE_URL');

$isLocal = (
    $_SERVER['HTTP_HOST'] == '127.0.0.1' ||
    $_SERVER['HTTP_HOST'] == 'localhost'
);

if($isLocal) {
    $url = $dotenv->get('BASE_URL_DEV');
}


$db_connection = $dotenv->get('DB_CONNECTION');
$db_host = $dotenv->get('DB_HOST');
$db_database = $dotenv->get('DB_DATABASE');
$db_username =  $dotenv->get('DB_USERNAME');
$db_password = $dotenv->get('DB_PASSWORD');

if($isLocal){

$db_connection = $dotenv->get('DB_CONNECTION_DEV');
$db_host = $dotenv->get('DB_HOST_DEV');
$db_database = $dotenv->get('DB_DATABASE_DEV');
$db_username =  $dotenv->get('DB_USERNAME_DEV');
$db_password = $dotenv->get('DB_PASSWORD_DEV');

}

define('DB_CONNECTION', $db_connection);
define('DB_HOST', $db_host);
define('DB_DATABASE', $db_database);
define('DB_USERNAME', $db_username);
define('DB_PASSWORD', $db_password);

define('IS_LOCAL', $isLocal);
define('URL_BASE', $url);
define('URL_ASSET', URL_BASE . 'asset/' );
define('URL_CSS', URL_ASSET . 'css/' );
define('URL_JS', URL_ASSET . 'js/' );
define('URL_IMG', URL_ASSET . 'img/' );

