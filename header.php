<?php 
    require_once 'db.php';
    $stmt = $pdo->query("select * from videos");
    $videos = $stmt -> fetchAll();

    // print_r($videos);
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <title><?=$titlepage?></title>
</head>
<body>
    <header>
        <div class="btn-head bd-btn">
            <a href="/">Главная</a>
        </div>
        <div class="btn-head">
            <a href="/about.php">О мне</a>
        </div>
        <div class="btn-head">
            <a href="/support.php">Поддержка</a>
        </div>
    </header>