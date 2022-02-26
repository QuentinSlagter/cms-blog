<?php 

$db['db_host'] = "us-cdbr-east-05.cleardb.net";
$db['db_user'] = "bb745881e4fa9b";
$db['db_pass'] = "4bf41795";
$db['db_name'] = "heroku_702abdf7086fecd";

foreach($db as $key => $value) {
  define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

// Cleaning up data so hackers cannot delete or modify any data
function escape($string) {
  global $connection;
  return mysqli_real_escape_string($connection, trim($string));
}
?>