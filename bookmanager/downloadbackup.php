<?php
$dumpFileName="C:\\xampp\htdocs\\bookmanager\downloadbackup.sql";
    exec('C:\\xampp\\mysql\\bin\\mysqldump -u root library >downloadbackup.sql');

  header("Content-Disposition: attachment; filename="."downloadbackup.sql");
  header("Pragma:no-cache");
  header("Expires:0");
  
  $hd = fopen ($dumpFileName,'rb');
  echo fread($hd,filesize($dumpFileName));
  fclose($hd);
?>