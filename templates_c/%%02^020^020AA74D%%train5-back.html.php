<?php /* Smarty version 2.6.32, created on 2021-11-25 08:12:52
         compiled from train5-back.html */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>會員資料</title>
</head>
<body>
    <div class="container">
        <h2>會員資料</h2>          
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>姓名</th>
                    <th>身份証號</th>
                    <th>生日</th>
                    <th>電話</th>
                    <th>郵遞區號</th>
                    <th>住址</th>
                    <th>功能</th>
                </tr>
            </thead>
            <tbody>
                <form action='train5-edit.php' method='get'>
                    <?php $_from = $this->_tpl_vars['rs']; if (($_from instanceof StdClass) || (!is_array($_from) && !is_object($_from))) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
                    <tr>
                        <td><?php echo $this->_tpl_vars['i']['name']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['i']['id']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['i']['birthday']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['i']['phone']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['i']['postcode']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['i']['address']; ?>
</td>
                        <td>
                            <button type='submit' class='btn btn-warning btn-xs' name='edit' value='<?php echo $this->_tpl_vars['i']['no']; ?>
'>編輯</button>
                            <button type='submit' class='btn btn-danger btn-xs' name='delete' value='<?php echo $this->_tpl_vars['i']['no']; ?>
'>刪除</button>
                        </td>
                    </tr>
                    
                    <?php endforeach; endif; unset($_from); ?>
                </form>
            </tbody>
        </table>
        <a href="/code/train5/train5.php" class="btn btn-info" >首頁</a>
    </div>
</body>
</html>