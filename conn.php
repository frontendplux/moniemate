<?php 
$host = $_SERVER['HTTP_HOST'] ?? '';

if ($host === 'localhost' || str_contains($host, '127.0.0.1') || str_contains($host, '172.20.10.10') || str_contains($host, 'localhost')) {

    define('db_host', 'localhost');
    define('db_user', 'root');
    define('db_pass', '');
    define('db_name', 'moniemateplux');

} else {

    define('db_host', 'sql211.infinityfree.com');
    define('db_user', 'if0_41851694');
    define('db_pass', '8vyR0j5014nT8');
    define('db_name', 'if0_41851694_monimate');
}
   $conn=new mysqli(db_host,db_user,db_pass) or die('unknow database connection');
   $conn->query('create database if not exists '. db_name);
   $conn->select_db(db_name);
?>