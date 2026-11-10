<?php
    require('../config/database.php');
    $sql = "SELECT 
                firstname, 
                lastname, 
                mobile_phone, 
                email, 
                photo_url, 
                case
                    when u.status = true then 'Active' else 'Inactive'
                end as status
            FROM users u
            ORDER BY firstname ASC";
    $res = pg_query($supa_conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Combox - List users</title>
        <link rel="icon" type="image/png" href="icons/icono.png">
    </head>
    <body>
        <center><h3>List all users</h3></center>
        <table border="1" align="center" width:80%>
            <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Mobile Phone</th>
                <th>Email</th>
                <th>Status</th>
                <th>Photo</th>
                <th>...</th>
            </tr>
            <?php
                while($row = pg_fetch_assoc($res)){
                    echo "<tr>";
                    echo "<td>" . $row['firstname'] . "</td>";
                    echo "<td>" . $row['lastname'] . "</td>";
                    echo "<td>" . $row['mobile_phone'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo "<td align='center'><img src='" . $row['photo_url'] . "'width='30'></td>";
                    echo "<td>
                            <img src='photos/search.png'width='15'>&nbsp;&nbsp;
                            <img src='photos/edit.png'width='15'>&nbsp;&nbsp;
                            <img src='photos/delete.png'width='15'>
                        </td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </body>
</html>