<?php
    //local connection
    $local_host = "localhost";//127.0.0.1
    $local_port = "5432";
    $local_user = "postgres";
    $local_dbname = "combox";
    $local_password = "unicesmag";

    $conn = pg_connect("
        host = $local_host
        port = $local_port
        dbname = $local_dbname
        user = $local_user
        password = $local_password
    ");

    if (!$conn){
        die("Error connection!!!");
    } else{
        echo "Connection success!!!";
    }


    //cloud connection
?>