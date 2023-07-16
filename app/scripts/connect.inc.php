<?php

$db_sgbd = "mysql";
$db_host = "localhost";
$db_name = "crud";
$db_user = "root";
$db_pass = "";

try
{
  $pdo    = new PDO("$db_sgbd:host=$db_host;dbname=$db_name",$db_user,$db_pass);
} 
catch (PDOException $e)
{
  die ('Connection to database failed! : '.$e->getMessage());
}