<?php

class StyleAndScriptSetup
{
  function __construct()
  {
    add_action('wp_enqueue_scripts', [$this, 'removeGlobalStyles']);
    add_action('wp_enqueue_scripts', [$this, 'removeWPBlockStyles']);
    add_filter('use_default_gallery_style', '__return_false');
    add_action('wp_footer', [$this, 'addThemeCSS'], 0);
    add_action('wp_footer', [$this, 'removeBuildInJS']);
    add_action('wp_enqueue_scripts', [$this, 'addThemeJS'], 0);
  }

  public function removeGlobalStyles()
  {
    wp_dequeue_style('global-styles');
    wp_dequeue_style('classic-theme-styles');
  }

  public function removeWPBlockStyles()
  {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-block-style'); // WooCommerce
  }

  public function addThemeCSS()
  {
    wp_enqueue_style('main', get_stylesheet_directory_uri() . '/css/main.min.css', false, filemtime(get_stylesheet_directory() . '/css/main.min.css'), 'all');
  }

  public function removeBuildInJS()
  {
    wp_deregister_script('jquery');
    wp_deregister_script('wp-embed');
  }

  public function addThemeJS()
  {
    wp_enqueue_script('main', get_stylesheet_directory_uri() . '/js/main.min.js', false, filemtime(get_stylesheet_directory() . '/js/main.min.js'), true);
  }
}
