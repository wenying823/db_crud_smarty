<!-- 資料新增 -->
<?php 
    include_once('./Smarty/Smarty.class.php');$smarty = new Smarty();
    $smarty -> template_dir = './templates'; //模板存放目錄
    $smarty -> compile_dir = './templates_c'; //編譯目錄
    $smarty -> left_delimiter = '{{'; //左定界符
    $smarty -> right_delimiter = '}}'; //右定界符
    $servername = "172.16.2.113";
    $username = "root";
    $password = "12345678";
    $dbname = "users";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if($_POST["name"]=="" && $_POST["id"]=="" && $_POST["birthday"]=="" && $_POST["phone"]=="" && $_POST["postcode"]=="" && $_POST["address"]==""){
        $url = "train5.php";
        echo "<script type='text/javascript'>";
        echo "window.location.href='$url'";
        echo "</script>"; 
    }else{
        $name = $_POST["name"];
        $id = $_POST["id"];
        $birthday = $_POST["birthday"];
        $phone = $_POST["phone"];
        $postcode = $_POST["postcode"];
        $address = $_POST["address"];
        $id = $_POST["id"];
        //驗證身分證是否重複
        $sql = "select *
                    from customer
                    where id = '$id'";
        $data = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($data);

        $sql_auth = "SELECT switch as switch FROM auth WHERE fun = 'id'";
        $sql_auth = mysqli_query($conn, $sql_auth);
        $result = $sql_auth->fetch_object();
        $id_auth = $result->switch;
        //要檢查身分證唯一值id_auth為T
        if($id_auth == "T"){
            if($num == 0){ 
                $msg = is_real_id($id);
                if($msg=="驗證通過"){
                    $sql = "SELECT MAX(NO) as NO FROM customer";
                    $data = mysqli_query($conn, $sql);
                    $result = $data->fetch_object();
                    //要找最大數字+1
                    $no = ($result->NO) + 1;
                    $name = $_POST["name"];
                    $birthday = $_POST["birthday"];
                    $birthday =  base64_encode($birthday);
                    $phone = $_POST["phone"];
                    $phone =  base64_encode($phone);
                    $postcode = $_POST["postcode"];
                    $address = $_POST["address"];
                    $address =  base64_encode($address);
                    $sql = "INSERT INTO customer (no,name,id,birthday,phone,postcode,address) 
                                VALUES('$no','$name','$id','$birthday','$phone','$postcode','$address')";
                    $conn->query($sql);
                    echo "<script>alert('資料新增完成')</script>";
                    $url = "train5.php";
                    echo "<script type='text/javascript'>";
                    echo "window.location.href='$url'";
                    echo "</script>";
                }
                else{
                    echo "<script>alert('身份證號$msg')</script>";
                    $smarty -> assign('name', $name);
                    $smarty -> assign('id', $id);
                    $smarty -> assign('birthday', $birthday);
                    $smarty -> assign('phone', $phone);
                    $smarty -> assign('postcode', $postcode);
                    $smarty -> assign('address', $address);
                    $smarty -> assign('id_auth', $id_auth);
                    $smarty -> display('train5-index.html');
                }
    
            }else{
                echo "<script>alert('身分證號重覆')</script>";
                $smarty -> assign('name', $name);
                $smarty -> assign('id', $id);
                $smarty -> assign('birthday', $birthday);
                $smarty -> assign('phone', $phone);
                $smarty -> assign('postcode', $postcode);
                $smarty -> assign('address', $address);
                $smarty -> assign('id_auth', $id_auth);
                $smarty -> display('train5-index.html');
            
            }
    
        }else{
            $msg = is_real_id($id);
            if($msg=="驗證通過"){
                $sql = "SELECT MAX(NO) as NO FROM customer";
                $data = mysqli_query($conn, $sql);
                $result = $data->fetch_object();
                //要找最大數字+1
                $no = ($result->NO) + 1;
                $name = $_POST["name"];
                $birthday = $_POST["birthday"];
                $birthday =  base64_encode($birthday);
                $phone = $_POST["phone"];
                $phone =  base64_encode($phone);
                $postcode = $_POST["postcode"];
                $address = $_POST["address"];
                $address =  base64_encode($address);
                $sql = "INSERT INTO customer (no,name,id,birthday,phone,postcode,address) 
                            VALUES('$no','$name','$id','$birthday','$phone','$postcode','$address')";
                $conn->query($sql);
                echo "<script>alert('資料新增完成')</script>";
                $url = "train5.php";
                echo "<script type='text/javascript'>";
                echo "window.location.href='$url'";
                echo "</script>";
            }
            else{
                echo "<script>alert('身份證號$msg')</script>";
                $smarty -> assign('name', $name);
                $smarty -> assign('id', $id);
                $smarty -> assign('birthday', $birthday);
                $smarty -> assign('phone', $phone);
                $smarty -> assign('postcode', $postcode);
                $smarty -> assign('address', $address);
                $smarty -> assign('id_auth', $id_auth);
                $smarty -> display('train5-index.html');
            }
            
        }
            
    }
    
    function is_real_id($id){
        $cardid = $id;
        $err ='';
        //先將字母數字存成陣列
        $alphabet =['A'=>'10','B'=>'11','C'=>'12','D'=>'13','E'=>'14','F'=>'15','G'=>'16','H'=>'17','I'=>'34',
                    'J'=>'18','K'=>'19','L'=>'20','M'=>'21','N'=>'22','O'=>'35','P'=>'23','Q'=>'24','R'=>'25',
                    'S'=>'26','T'=>'27','U'=>'28','V'=>'29','W'=>'32','X'=>'30','Y'=>'31','Z'=>'33'];
        //檢查字元長度
        if(strlen($cardid) !=10){$err = '1';}//長度不對

        //驗證英文字母正確性
        $alpha = substr($cardid,0,1);//英文字母
        $alpha = strtoupper($alpha);//若輸入英文字母為小寫則轉大寫
        if(!preg_match("/[A-Za-z]/",$alpha)){
            $err = '2';}else{
                //計算字母總和
                $nx = $alphabet[$alpha];
                $ns = $nx[0]+$nx[1]*9;//十位數+個位數x9
            }

        //驗證男女性別
        $gender = substr($cardid,1,1);//取性別位置
        if($gender !='1' && $gender !='2'){$err = '3';}//驗證性別

        //N2x8+N3x7+N4x6+N5x5+N6x4+N7x3+N8x2+N9+N10
        if($err ==''){
            $i = 8;
            $j = 1;
            $ms =0;
            //先算 N2x8 + N3x7 + N4x6 + N5x5 + N6x4 + N7x3 + N8x2
            while($i >= 2){
                $mx = substr($cardid,$j,1);//由第j筆每次取一個數字
                $my = $mx * $i;//N*$i
                $ms = $ms + $my;//ms為加總
                $j+=1;
                $i--;	
            }
            //最後再加上 N9 及 N10
            $ms = $ms + substr($cardid,8,1) + substr($cardid,9,1);
            //最後驗證除10
            $total = $ns + $ms;//上方的英文數字總和 + N2~N10總和
            if( ($total%10) !=0){$err = '4';}
        }
        //錯誤訊息返回
        switch($err){
            case '1':$msg = '字元數錯誤';break;
            case '2':$msg = '英文字母錯誤';break;
            case '3':$msg = '性別錯誤';break;
            case '4':$msg = '驗證失敗';break;
            default:$msg = '驗證通過';break;
        }
        return $msg;
    }
?>
