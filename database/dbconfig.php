<?php
    define('_HOST_NAME', 'localhost');
    define('_DATABASE_USER_NAME', 'root');
    define('_DATABASE_PASSWORD', '');
    define('_DATABASE_NAME', 'db_multiform');
	
    $dbConnection = new mysqli(_HOST_NAME, _DATABASE_USER_NAME, _DATABASE_PASSWORD, _DATABASE_NAME);
    if ($dbConnection->connect_error) {
        trigger_error('Connection Failed: '  . $dbConnection->connect_error, E_USER_ERROR);
     }