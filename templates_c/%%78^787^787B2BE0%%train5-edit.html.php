<?php /* Smarty version 2.6.32, created on 2021-11-26 03:11:10
         compiled from train5-edit.html */ ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>會員資料修改</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script>
            function valfunction() {
                var id = $('#id').val();
                $.ajax({
                    type: "post",
                    url: "train5-check.php",
                    data:  {id:id},
                    dataType: "text",
                        success: function(msg){
                            var data='';
                            if(msg!=''){
                                data = eval("("+msg+")");
                            }
                            console.log(data);
                            var error_msg = document.getElementById("error_msg");
                            var error_class = document.getElementById("val_id");
                            error_msg.innerHTML = data;
                            if(data=="驗證通過"){
                                error_class.classList.remove("has-error");
                                error_class.classList.add("has-success");
                                error_msg.style.color="#008000";
                            }else{
                                error_class.classList.remove("has-success");
                                error_class.classList.add("has-error");
                                error_msg.style.color="#FF0000";
                            }
                        },
                        error:function(msg){
                            console.log(msg);
                        }
                });
            }

        </script>
    </head>
    <body>

        <div class="container">
            <h2>會員資料<font color="red">修改</font></h2>

            <form action="train5-edit.php" method="post">
                <div class="form-group">
                    <label for="name">姓名:</label>
                    <input type="name" class="form-control" required="required" id="name" placeholder="請輸入姓名" name="name" value="<?php echo $this->_tpl_vars['name']; ?>
">
                </div>
                <div id="val_id" class="form-group">
                    <label for="id">身分證字號:</label>
                    <input type="id" class="form-control" id="id" placeholder="請輸入身分證字號" name="id" required="required" value="<?php echo $this->_tpl_vars['id']; ?>
" onkeyup="valfunction()" autocomplete="off">
                    <div class="feedback" id="error_msg">請填入身分證字號</div>
                </div>
                <div class="form-group">
                    <label for="birthday">生日:</label>
                    <input type="date" class="form-control" required="required" id="birthday" placeholder="請輸入生日" name="birthday" value="<?php echo $this->_tpl_vars['birthday']; ?>
">
                </div>
                <div class="form-group">
                    <label for="n">電話:</label>
                    <input type="phone" class="form-control" required="required" id="phone" placeholder="請輸入電話" name="phone" value="<?php echo $this->_tpl_vars['phone']; ?>
">
                </div>
                <div class="form-group">
                    <label for="postcode">郵遞區號:</label>
                    <input type="postcode" class="form-control" required="required" id="postcode" placeholder="請輸入郵遞區號" name="postcode" value="<?php echo $this->_tpl_vars['postcode']; ?>
">
                </div>
                <div class="form-group">
                    <label for="address">住址:</label>
                    <input type="address" class="form-control" required="required" id="address" placeholder="請輸入住址" name="address" value="<?php echo $this->_tpl_vars['address']; ?>
">
                </div>
                <button type="submit" class="btn btn-success" value="<?php echo $this->_tpl_vars['no']; ?>
" name="update">修改</button>
            </form>
            <br>
            <form action="train5-back.php" method="post">
                <button type="submit" class="btn btn-danger">返回</button>
            </form>
        </div>

    </body>
</html>