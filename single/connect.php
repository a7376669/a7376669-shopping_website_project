<?php
session_start();
try {
$pdo=new PDO("mysql:host=localhost;dbname=library","root","");
} catch (PDOException $e) {
die("資料庫無法連接，訊息:{$e->getMessage()}");
}?>