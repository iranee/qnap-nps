<?php include 'login.php'; ?>
<html>
	<head>
		<title>NPC 网络穿透客户端</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="static/style.css">
    <link rel="shortcut icon" href="static/favicon.ico" type="image/x-icon">    
	</head>
	<body>
				<?php
					$info=file_get_contents("../conf/npc.conf");
					preg_match_all('/(.*)=(.*)/',$info,$arr);
				?>
		
<div class="div">
		<b>NPC 网络穿透客户端 - 配置文件</b><p>

<?php
if(isset($_POST['content'])){
file_put_contents('../conf/npc.conf', $_POST['content']);
//echo "<script language=\"JavaScript\">alert(\"修改成功！\");</script>";
echo "<script>location.href='edit.php';</script>";
exec("echo $(jq -c .change='\"1\"' cat $(getcfg 'npc' Install_Path -f '/etc/config/qpkg.conf')/conf/npc-config.json)> $(getcfg 'npc' Install_Path -f '/etc/config/qpkg.conf')/conf/npc-config.json");

}
$confile=file('../conf/npc.conf');
?>

<form name="" method="post" action=""> 
<textarea name="content" id="content" rows="20" cols="62">
<?php
for ($i=0;$i<count($confile);$i++){
  echo  $confile[$i]."";
}
?>
</textarea>
<tr>

<div style="text-align:center;margin:0 auto; width:380px;">
<br>
<input type="submit" name="Submit" class="button" value="保存" />
<input type='reset' class="button" />
<input type="button" name="Submit" value="返回" class="button" onclick="location.href='index.php'" />
</div>
</form>
</div>
</body>
</html>
