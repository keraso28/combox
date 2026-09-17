<?php
    //Get data from html form (client)
    $f_name=$_POST['fname'];
    $l_name=$_POST['lname'];
    $m_phone=$_POST['mphone'];
    $e_mail=$_POST['email'];
    $p_assword=$_POST['psw'];

    echo "Firstname is: ". $f_name;
    echo "<br>Lastname is: ". $l_name;
    echo "<br>Mobile Phone is: ". $m_phone;
    echo "<br>E-mail is: ". $e_mail;
    echo "<br>Password is: ". $p_assword;
?>