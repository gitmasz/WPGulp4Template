<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="utf-8">
  <meta name="author" content="Marcin Szczepkowski">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
  <?php wp_head(); ?>
</head>

<body>
  <?php
    require_once dirname(__FILE__) . "/vendor/autoload.php";
    $preloaderHTML = new PreloaderHTML;
    $preloaderHTML->addPreloader();
  ?>