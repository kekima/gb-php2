<?php
declare(strict_types=1);

ini_set('error_reporting', (string)E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

require_once 'vendor/autoload.php';

define("BIGIMG", "/gallery_img/big/");
define("THUMBIMG", "/gallery_img/small/");

try {
  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  $dbh = new PDO('mysql:dbname=gb;host=localhost:3307', 'root', 'root');
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "SELECT * FROM `images` ORDER BY views DESC";
  $sth = $dbh->query($sql);
  $images = [];
  while ($row = $sth->fetchObject()) {
    $images[] = $row;
  }
  if (empty($images)) {
    throw new Exception("No images to show!<br>");
  }

  $template = $twig->load('3_gallery.tmpl');
  $template->display([
    'title' => 'Image gallery',
    'imgpath' => BIGIMG,
    'thumbpath' => THUMBIMG,
    'images' => $images
  ]);

} catch (PDOException $e) {  
  echo "Database error!<br>" . $e->getMessage();
} catch (Throwable $e) {
  echo 'Error! ' . $e->getMessage();
} finally {
  echo "<br>Page finished loading.";
}
