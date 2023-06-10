<?php

class RedirectsSetup
{
  function __construct()
  {
    add_action('wp_login', [$this, 'redirectAfterLogin']);
    add_action('wp_logout', [$this, 'redirectAfterLogout']);
    add_action('template_redirect', [$this, 'redirectAuthorPage']);
    add_action('template_redirect', [$this, 'redirectDatePage']);
    // add_action( 'template_redirect', [$this, 'redirectTagPage'] );
    // add_action( 'template_redirect', [$this, 'redirectCategoryPage'] );
    // add_action( 'template_redirect', [$this, 'redirectPostType'] );
    // add_action( 'admin_menu', [$this, 'removeAdminMenuPostType'] );
  }

  public function redirectAfterLogin()
  {
    wp_safe_redirect(home_url());
    exit;
  }

  public function redirectAfterLogout()
  {
    wp_safe_redirect(home_url());
    exit;
  }

  public function redirectAuthorPage()
  {
    if (is_author()) {
      global $wp_query;
      $wp_query->set_404();
      status_header(404);
    }
  }

  public function redirectDatePage()
  {
    if (is_date()) {
      global $wp_query;
      $wp_query->set_404();
      status_header(404);
    }
  }

  public function redirectTagPage()
  {
    if (is_tag()) {
      global $wp_query;
      $wp_query->set_404();
      status_header(404);
    }
  }

  public function redirectCategoryPage()
  {
    if (is_category()) {
      global $wp_query;
      $wp_query->set_404();
      status_header(404);
    }
  }

  public function redirectPostType()
  {
    if (get_post_type() == 'post') {
      global $wp_query;
      $wp_query->set_404();
      status_header(404);
    }
  }

  public function removeAdminMenuPostType()
  {
    remove_menu_page('edit.php');
  }
}
