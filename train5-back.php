<?php
    include_once('./Smarty/Smarty.class.php');$smarty = new Smarty();
    $smarty -> template_dir = './templates'; //模板存放目錄
    $smarty -> compile_dir = './templates_c'; //編譯目錄
    $smarty -> left_delimiter = '{{'; //左定界符
    $smarty -> right_delimiter = '}}'; //右定界符
    $smarty -> assign('test','OK');
    $servername = "172.16.2.113";
    $username = "root";
    $password = "12345678";
    $dbname = "users";
    $conn = new mysqli($servername, $username, $password, $dbname);
    // $sql = "INSERT INTO customer (name,id,birthday,phone,postcode,address) VALUES('Todd','12345678','1999-08-23','0912345678','456','test')";
    // $conn->query($sql);
    $sql = "SELECT * FROM customer";
    $data = mysqli_query($conn, $sql);
    if(mysqli_num_rows($data)!=0){
        for ($i=0; $i < mysqli_num_rows($data); $i++) {
            $rs = mysqli_fetch_array($data,MYSQLI_ASSOC);        
            $rs_array[$i] = array("no" => $rs['no'],
                                    "name" => $rs['name'],
                                    "id" => $rs['id'],
                                    "birthday" => base64_decode($rs['birthday']),
                                    "phone" => base64_decode($rs['phone']),
                                    "postcode" => $rs['postcode'],
                                    "address" => base64_decode($rs['address']));
            
        }
        $smarty -> assign("rs", $rs_array);
        $smarty -> display('train5-back.html');
    }else{
        $smarty -> display('train5-back.html');

    }


    
?>