<?php
    //Get data base connection
    require('../config/database.php');

    //Get data from html form (client)
    $f_name=$_POST['fname'];
    $l_name=$_POST['lname'];
    $m_phone=$_POST['mphone'];
    $e_mail=$_POST['email'];
    $p_assword=$_POST['psw'];

    $hashed_password = password_hash($p_assword, PASSWORD_DEFAULT);

    //
    $sql_validation = "
        SELECT u.email FROM users u WHERE u.email = '$e_mail'
    ";

    $supa_res = pg_query($supa_conn, $sql_validation);

    if(pg_num_rows ($supa_res) > 0){
        echo "<script>alert('User email already exists :::')</script>";
        header('refresh:0;url=signup.html');
    }else{
        $sql = "
        INSERT INTO users (
            firstname, lastname, mobile_phone, email, password
        )
        VALUES(
            '$f_name', '$l_name', '$m_phone', '$e_mail', '$hashed_password'
        )
        ";

        $local_res = pg_query($local_conn, $sql);
        $supa_res = pg_query($supa_conn, $sql);

        if($supa_res){
            echo "<script>alert('User has been created successfully into supabase database !!!')</script>";
            header('refresh:0;url=signin.html');
        } else{
            echo "User hasn't been created into supabase database !!!<br>";
        }
    }
?>
