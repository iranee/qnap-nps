<?php
include 'login.php';

if ( isset($_POST['command']) ) 
{
  $command = $_POST['command'];
  $pwd = $_POST['pwd'];
  $json_str = '{"command":"' . $command . '","pwd":"' . $pwd . '","change":"1"}';
  file_put_contents('../conf/npc-config.json', $json_str);
}

?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NPC 网络穿透客户端</title>
    <link rel="shortcut icon" href="static/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="static/style.css">
    <script src="static/jquery-2.2.3.min.js" type="text/javascript"></script>
	<style>

    </style>
</head>

<body>
<div class="div">
<b>NPC 网络穿透客户端 - 设置面板</b><p>
<p align="right"><a href='index.php?logout'><input type="button" value="退出登录" class="button"></input></a></p>
<form id="npc_form" action="" method="post">
<div id="main">    
<table border="0" style="width: 500px;">
<tbody>

<tr><td><b>登录密码</b></td>
<td><div class='password-wrap'><div class='password-input'><input placeholder='默认密码:123456，建议修改' name='pwd' id="pwdx" value='' type='password' size='40'  class='bui-input' autocomplete='new-password' /></div><i class='bt-showpwd off'></i></div></td></tr>


<tr><td><b>命令参数</b></td>
<td><div class='password-wrap'><div class='password-input'><input placeholder='客户端命令是./npc之后的内容' name='command' id="device_command" value='' type='text' size='40'  class='bui-input' autocomplete='new-password' autocomplete="off" /></div><i class='bt-showpwd off'></i></div></td></tr>


<td colspan='2'><br />
<p span style="color:green;">当『命令参数』为<font color="red">１</font>时开启<font color="#ff6a00">配置文件</font>启动模式，否则运行<font color="#ff6a00">客户端命令</font><br /><br />『客户端命令』填入从<font color="#ff6a00">服务端</font>获取命令的红字部分：<br />./npc <font color="red">-server=IP:8024 -vkey=******** -type=tcp</font></span></p>
<p><span id="spn_message">进程状态检测中...</span><br />
<p align='center' >
    <br />
<input type="submit" value="  保  存  " name="sub" class="button">&nbsp&nbsp&nbsp<input type="button" name="Submit" value="自定义" class="button" onclick="document.location='edit.php'" />
</p>
</td>
</table>

</div>
</form>  
</div>
</body>

<script>
<?php
    echo 'var npc_config=';
    echo file_get_contents("../conf/npc-config.json");
    echo ';';
?>

    var check_npc_pid = 0;

    var timeoutfn = function() { 
      if (check_npc_pid > 19) {
        $("#spn_message").html("进程启动失败！请检查参数是否存在问题");
        return;
      }
      check_npc_pid++;

      $.ajax({
        type: 'GET',
        dataType: 'text',
        url: 'npc-pid.php',
        timeout: 5000,
        success: function(dataText, textStatus ){
          var data = jQuery.parseJSON(dataText);
          if(data["pid"]) {
            $("#spn_message").html("进程运行中，PID：" + data["pid"] + " | 程序版本：" + data["ver"]);
          } else {
            $("#spn_message").html("等待进程检测中，次数：" + check_npc_pid);
            setTimeout(timeoutfn, 3000);
          }
        },
        fail: function(xhr, textStatus, errorThrown){
          console.log('check pid request failed');
        }
      });

    };

    $(document).ready(function() {
      $('#npc_form').submit(function(e) {
        var devicecommand = $("#device_command").val();
        var password = $('#pwdx').val();
        if (devicecommand == "" || devicecommand.length == 0 || devicecommand == null) {
            $("#spn_message").html("命令参数不能为空!");
            check_npc_pid = 10;
            return false;
        }
        if (password == "" || password.length == 0 || password == null) {
            $("#spn_message").html("密码不能为空！");
            check_npc_pid = 10;
            return false;
        }
        check_npc_pid = 10;
        $("#spn_message").html("提交中...");

        return true;
      });

      $("#device_command").val(npc_config["command"]);
      $('#pwdx').val(npc_config["pwd"]);
      timeoutfn();

    });

</script>
<script type="text/javascript">
    $(".bt-showpwd").on("click",  function (e) {
        e.preventDefault();
        var $this = $(this);
        var $password = $this.closest(".password-wrap");
        var $input = $password.find('input');
        var $inputWrap = $password.find('.password-input');
        var newinput = '', inputHTML = $inputWrap.html(), inputValue = $input.val();
        if ($input.attr('type') === 'password') {
            newinput = inputHTML.replace(/type\s*=\s*('|")?password('|")?/ig, 'type="text"');
            $inputWrap.html(newinput).find('input')[0].value = inputValue;
            $this.removeClass("off").addClass("on");
        } else {
            newinput = inputHTML.replace(/type\s*=\s*('|")?text('|")?/ig, 'type="password"');
            $inputWrap.html(newinput).find('input')[0].value = inputValue;
            $this.removeClass("on").addClass("off");
        }
    });
</script>
</div>
</html>
