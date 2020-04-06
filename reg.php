<?php
    try
    {
        include 'db.php';
        $hashpasw = password_hash($_POST["password"], PASSWORD_BCRYPT);
        $nameuser = $_POST["name"];
        $login = $_POST["email"];
        echo '1' . $login . '1';
        $sql = 'insert into "user" (login, password, type, name) VALUES (\''. $login . '\', \'' . $hashpasw . '\', 0, \'' . $nameuser . '\')';
        $db->query($sql);
    } catch (PDOException $e)
    {
        print "Error!: " . $e->getMessage();
        die();
    }
?>