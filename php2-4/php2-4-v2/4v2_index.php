<?php
declare(strict_types=1);

ini_set('error_reporting', (string)E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

require_once 'vendor/autoload.php';

include_once '4v2_config.php';

define("BIGIMG", "/gallery_img/big/");
define("THUMBIMG", "/gallery_img/small/");

try {
  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  $sql = "SELECT COUNT(*) as counter FROM images";
  $sth = $pdo->query($sql);
  $list = $sth->fetch(PDO::FETCH_ASSOC);
  $totalImages = $list['counter'];
  $imagesPerLoad = 2;

  $sql = ("SELECT * FROM `images` ORDER BY views DESC LIMIT 0, ". $imagesPerLoad);
  $sth = $pdo->query($sql);
  $images = [];
  while ($list = $sth->fetchObject()) {
    $images[] = $list;
  }
  if (empty($images)) {
    throw new Exception("No images to show!<br>");
  }

  $template = $twig->load('4v2_gallery.tmpl');
  $template->display([
    'title' => 'Image gallery',
    'imgpath' => BIGIMG,
    'thumbpath' => THUMBIMG,
    'totalImages' => $totalImages,
    'images' => $images
  ]);
} catch (PDOException $e) {  
    echo "Database error!<br>" . $e->getMessage();
} catch (Throwable $e) {
    echo 'Error! ' . $e->getMessage();
}


