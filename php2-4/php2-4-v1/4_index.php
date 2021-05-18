<?php
declare(strict_types=1);

ini_set('error_reporting', (string)E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

require_once 'vendor/autoload.php';

include_once '4_db.php';

try {
  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  $sql = "SELECT COUNT(*) as counter FROM images";
  $sth = $pdo->query($sql);
  $row = $sth->fetch(PDO::FETCH_ASSOC);
  $totalPages = ceil($row['counter']/ITEM_NUM);

  $template = $twig->load('4_gallery.tmpl');
  $template->display([
    'title' => 'Image gallery',
    'total_pages' => $totalPages
  ]);
} catch (PDOException $e) {
  //var_dump($e);
  echo "Error: can't connect. " . $e->getTraceAsString();
}
