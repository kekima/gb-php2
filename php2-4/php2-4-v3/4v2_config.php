<?php

try {
    $pdo = new PDO('mysql:dbname=gb;host=localhost:3307', 'root', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $err) {
    die("Error! " . $err->getMessage());
}