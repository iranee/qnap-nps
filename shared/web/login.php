<?php
$pwd = exec("cat $(getcfg 'npc' Install_Path -f '/etc/config/qpkg.conf')/conf/npc-config.json | jq -r '.pwd'");
session_start();
if(@$_POST['password'] == $pwd){
$_SESSION['login'] = md5($pwd);
}
if($_SERVER['QUERY_STRING'] == "logout"){
$_SESSION['login'] = "";
header("location: " . $_SERVER['PHP_SELF']);
exit();
}
$html_login = <<<EOF
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		    <style>
    h4 img{
        display:none;
    }
    h4:hover img{
        display:block;
    }	
        input{
            border: 1px solid #ccc;
            border-radius: 2px;
            color: #000;
            font-family: 'Open Sans', sans-serif;
            font-size: 1em;
            height: 35px;
            padding: 0 16px;
            transition: background 0.3s ease-in-out;
        }
        input:focus {
            outline: none;
            border-color: #9ecaed;
            box-shadow: 0 0 10px #9ecaed;
        }
        .button{
            -webkit-appearance: none;
            background: #009dff;
            border: none;
            border-radius: 2px;
            color: #fff;
            cursor: pointer;
            height: 35px;
            font-family: 'Open Sans', sans-serif;
            font-size: 1em;
            letter-spacing: 0.05em;
            text-align: center;
            text-transform: uppercase;
            transition: background 0.3s ease-in-out;
            width: 120px;
        }
        .button:hover {
            background: #00c8ff;
        }
        .login{
            -webkit-appearance: none;
            background: #009dff;
            border: none;
            border-radius: 2px;
            color: #fff;
            cursor: pointer;
            height: 35px;
            font-family: 'Open Sans', sans-serif;
            font-size: 1em;
            letter-spacing: 0.05em;
            text-align: center;
            text-transform: uppercase;
            transition: background 0.3s ease-in-out;
            width: 100px;
        }
        .login:hover {
            background: #00c8ff;
        }
        body{ text-align:left} 
        .div{ margin:0 auto; width:400px;} 
        .div_login{ margin:0 auto; width:210px;} 
    </style>
</head>    

<div class="div_login"><br><br><br><br><br>
<h2>用户登录验证</h2>
<form action="" method="post">
<input type="password" name="password" autocomplete="new-password" />
<p>
<input type="submit" value="登录" class="login"/>
</form>
</div>

</body>
</html>
EOF;
if(@$_SESSION['login'] != md5($pwd)){
exit($html_login);
}
?>
