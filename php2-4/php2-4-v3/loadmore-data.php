<?php
include_once "4v2_config.php";
require_once 'vendor/autoload.php';

define("BIGIMG", "/gallery_img/big/");
define("THUMBIMG", "/gallery_img/small/");

try {
  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  if (isset($_POST['row'])) {
    $start = $_POST['row'];
    $limit = 2;
    $results = $pdo->prepare("SELECT * FROM images ORDER BY views DESC LIMIT ".$start.",".$limit);
    $results->execute();

  while($list = $results->fetch(PDO::FETCH_ASSOC)) {
    $images[] = $list;
  }
  $template = $twig->load('4v2_body.tmpl');
  $template->display([
    'imgpath' => BIGIMG,
    'thumbpath' => THUMBIMG,
    'images' => $images
  ]);
  }
} catch (PDOException $e) {
  echo "Error: can't connect. " . $e->getTraceAsString();
}