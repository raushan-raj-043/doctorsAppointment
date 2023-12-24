<?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'password');
    define('DB_DATABASE', 'doctors_db');

    // attempt to connect to mysql database
    $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

    // Check connection
    if ($db === false) {
        die("ERROR: Could not connect. " . $db->connect_error);
    }
    function notify_success($message){
        echo "<span class='success'>$message</span>";
     }
  
     function notify_error($message){
        echo "<span class='error'>$message</span>";
     }
?>