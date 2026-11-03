<?php
    require('../config/database.php');

    session_start();

    if(!isset($_SESSION['userId'])){
        header('refresh:0;url=home.php');
    }

    $email = $_POST['email'];
    $passwd = $_POST['passwd'];
    $pass_enc = md5($passwd);

    $sql = "SELECT u.*, u.firstname || '' ||u.lastname as fullname FROM users u WHERE email = '$email' AND password = '$pass_enc'";
    $res = pg_query($supa_conn, $sql);

    if(pg_num_rows($res) > 0){
        $row = pg_fetch_assoc($res);

        $_SESSION['userId']=$row['id'];
        $_SESSION['fullName']=$row['fullname'];
        $_SESSION['fName']=$row['firstname'];
        $_SESSION['lName']=$row['lastname'];

        header('refresh:0;url=home.php');
    }else{
        echo "<script>alert('Invalid email or password :::')</script>";
        header('refresh:0;url=signin.html');
    }
?>