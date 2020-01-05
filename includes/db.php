<?php 
    ob_start();
    
    /* In video 84, we have to safeguard our database. To do that we've to convert the letters to nos.
    In order to do that we first store our data in an associative array and then convert it into nos. */
    $db['db_host'] = 'localhost'; //host
    $db['db_user'] = 'root'; //username
    $db['db_pass'] = ''; //password = NULL
    $db['db_name'] = 'cms'; //database name

    foreach($db as $key => $value){
        define(strtoupper($key), $value);
    }
    
    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
/*    if($connection){
        echo "Successful!";
    } else {
        echo "Not Successful!";
    }
*/
?>