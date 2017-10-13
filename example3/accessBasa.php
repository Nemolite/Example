<?php
try
{
  $pdo = new PDO('mysql:host=localhost;dbname=test', 'user', 'userroot');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->exec('SET NAMES "utf8"');
}
catch (PDOException $e)
{
  $output = 'Не удалось подключится к базе данны.';
  include 'error.php';
  exit();
}

try
{
  $sql = 'CREATE TABLE users (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        name TEXT,
        date DATE NOT NULL
      ) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB';
  $pdo->exec($sql);
}
catch (PDOException $e)
{
  $output = 'Error при создание таблицы : ' . $e->getMessage();
  include 'error.php';
  exit();
}