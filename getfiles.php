<?php 
    session_start();
    include 'db.php';
    if(!isset($_GET['idfile']))
    {
        header('Location: http://lgtu.ru/');
        return;
    }
    $sql = 'select * from "file" where "file".idfile = '. ((int)$_GET['idfile']);
    $file = ($db->query($sql))->fetchAll(PDO::FETCH_ASSOC);
    $linkfile = $file[0]['linkfile'];

    ob_end_clean();
 
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($linkfile));
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: ' . filesize($linkfile));
 
    readfile($linkfile);

    echo "1111";
?>