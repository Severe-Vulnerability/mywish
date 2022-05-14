<?php
//此文件实现数据库连接，其他文件通过引入该脚本获取数据库连接对象，从而对数据库进行操作
$hostname = 'localhost';
$username = 'root';
$password = '123456';
$dbnamme = 'php_wish';
$port = '3306';
$link = mysqli_connect($hostname,$username,$password,$dbnamme,$port);
$GLOBALS['link'] = $link;
if(mysqli_connect_errno()){
    sprintf("Error Code: %d,Error info: %s",mysqli_connect_errno(),mysqli_connect_error());
}
mysqli_set_charset($link,'utf8');