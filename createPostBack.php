<?php
    session_start();
    if(!isset($_SESSION['username']) || !isset($_SESSION['login']))
    {
        session_destroy();
        header('Location: http://lgtu.ru/');
        return;
    }
    $namepost = $_POST['namePost'];
    $textpost = $_POST['textPost'];
    include 'db.php';
    $sql = 'SELECT * FROM "user" where login = \'' . $_SESSION['login'] . '\'';
    $iduser = $db->query($sql)->fetch(PDO::FETCH_LAZY)->iduser;
    $sql = 'insert into "posts" (iduser, name, datecreating, text) VALUES ('. $iduser . ', \'' . $namepost . '\', now(), \'' . $textpost . '\') returning idpost';
    $lastidpost = ($db->query($sql))->fetch(PDO::FETCH_LAZY)->idpost;
    if(isset($_FILES['userfile']['name'][0]))
    {
        foreach($_FILES['userfile']['error'] as $key => $error)
        {
            if($error == UPLOAD_ERR_OK)
            {
                $uploaddir = '/files/' . $_SESSION['username'] . '/' . $lastidpost;
                if(!file_exists($uploaddir))
                {
                    mkdir($uploaddir, 0777, true);
                }
                $uploaddir = $uploaddir . '/';
                $uploadfile = $uploaddir . basename($_FILES['userfile']['name'][$key]);
                if(move_uploaded_file($_FILES['userfile']['tmp_name'][$key], $uploadfile))
                {
                   $sql = 'insert into file (idpost, linkfile) VALUES (' . $lastidpost . ', \'' . $uploadfile. '\')'; 
                   echo $sql;
                   $db->query($sql);
                }
            }
        }
        header('Location: http://lgtu.ru/');
        return;
    }
    else
    {
        echo "Error file2";
    }
    //header('Location: http://lgtu.ru/');
?>