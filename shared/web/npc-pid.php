<?php
  header('Content-type: application/json');
  $npc_pid = shell_exec('pidof npc');
  $npc_pid = preg_replace("/\r\n|\r|\n/",'',$npc_pid);
  $npc_ver = shell_exec("../npc --version | awk -F: 'NR==1 {print $2}'");
  $npc_ver = preg_replace("/\r\n|\r|\n/",'',$npc_ver);
  echo '{"pid":"';
  echo $npc_pid;
  echo '","ver":"';
  echo $npc_ver;
  echo '"}';
?>
