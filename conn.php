<?php 

$host = "localhost";
$user = "root";
$pass = "";
$db   = "cee_db2";
$conn = null;

try {
  $conn = new PDO("mysql:host={$host};dbname={$db};charset=utf8",$user,$pass);

} catch (Exception $e) {
  
}
// include("lib/getval.php");
// $cmn = new TestCommandRun();


$simple_string = "0"; 
$ciphering = "AES-128-CTR";
$iv = '1234567891011121'; 
$key = "OnLineTest";
$iv_length = openssl_cipher_iv_length($ciphering); 
$options = 0;
 ?>