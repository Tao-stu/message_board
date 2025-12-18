<?php
$host = "localhost";
$username = "root";
$password = "123456";
$database = "test";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_errno) {
    die("数据库连接失败: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>