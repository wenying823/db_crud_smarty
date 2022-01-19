<?php

    include_once('./Smarty/Smarty.class.php');$smarty = new Smarty();
    $smarty -> template_dir = './templates'; //模板存放目錄
    $smarty -> compile_dir = './templates_c'; //編譯目錄
    $smarty -> left_delimiter = '{{'; //左定界符
    $smarty -> right_delimiter = '}}'; //右定界符
    $smarty -> assign('test','OK');
    $smarty -> display('train5-index.html');
    $servername = "172.16.2.113";
    $username = "root";
    $password = "12345678";
    $dbname = "users";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql_auth = "SELECT switch as switch FROM auth WHERE fun = 'id'";
    $sql_auth = mysqli_query($conn, $sql_auth);
    $result = $sql_auth->fetch_object();
    $id_auth = $result->switch;
    if($id_auth == "T"){
        $sql = "update auth set switch ='F' where fun = 'id'";
        $data = mysqli_query($conn, $sql);

    }else{
        $sql = "update auth set switch ='T' where fun = 'id'";
        $data = mysqli_query($conn, $sql);
    }
    $url = "train5.php";
    echo "<script type='text/javascript'>";
    echo "window.location.href='$url'";
    echo "</script>";

?>