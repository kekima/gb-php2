<?php
include_once "4_db.php";
require_once 'vendor/autoload.php';

define("BIGIMG", "/gallery_img/big/");
define("THUMBIMG", "/gallery_img/small/");

try {
  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  $pageNum = isset($_POST["page"]) ? ((int) $_POST["page"] ? (int) $_POST["page"] : 1) : 1;

  // get record starting position
  //$start = ($pageNum-1) * ITEM_NUM;
  $start = 0;

  $results = $pdo->prepare("SELECT * FROM images ORDER BY views DESC LIMIT $start, ". ITEM_NUM*$pageNum);
  $results->execute();

  while($row = $results->fetch(PDO::FETCH_ASSOC)) {
    $images[] = $row;
  }
  $template = $twig->load('4_body.tmpl');
  $template->display([
    'imgpath' => BIGIMG,
    'thumbpath' => THUMBIMG,
    'images' => $images
  ]);
} catch (PDOException $e) {
  echo "Error: can't connect. " . $e->getTraceAsString();
}
?>
