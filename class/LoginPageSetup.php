<?php

class LoginPageSetup
{
  private string $css_file;

  private string $js_file;

  function __construct()
  {
    add_action('login_head', [$this, 'addLoginStyle']);
    add_filter('login_headerurl', [$this, 'changeLoginHeaderURL']);
    add_filter('login_headertitle', [$this, 'changeLoginHeaderTitle']);
    add_action('login_init', [$this, 'disableLostPasswordFunctionality']);
    add_filter('login_footer', [$this, 'removeLoginFooter']);
    add_filter('login_display_language_dropdown', '__return_false');
  }

  public function addLoginStyle()
  {
    $this->css_file = dirname(__DIR__) . '\css\wp-login.min.css';
    if (file_exists($this->css_file)) {
      echo '<link rel="stylesheet" href="' . get_stylesheet_directory_uri() . '/css/wp-login.min.css" type="text/css" media="all" />';
    }
  }

  public function changeLoginHeaderURL()
  {
    return esc_url(site_url('/'));
  }

  public function changeLoginHeaderTitle()
  {
    return get_bloginfo('name');
  }

  public function disableLostPasswordFunctionality()
  {
    if (isset($_GET['action'])) {
      if (in_array($_GET['action'], array('lostpassword', 'retrievepassword'))) {
        wp_redirect(wp_login_url(), 301);
        exit;
      }
    }
  }

  public function removeLoginFooter()
  {
    $this->js_file = dirname(__DIR__) . '\js\wp-login.min.js';
    if (file_exists($this->js_file)) {
      echo '<script>' . file_get_contents($this->js_file) . '</script>';
    }
  }
}
