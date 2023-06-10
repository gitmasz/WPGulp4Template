<?php

class UsersSetup
{
  function __construct()
  {
    add_action('admin_head', [$this, 'hideNoticesForNonAdmin']);
    add_action('init', [$this, 'restrictAdminPannelForNonAdmin']);
    add_filter('send_email_change_email', '__return_false');
    add_filter('send_password_change_email', '__return_false');
  }

  public function hideNoticesForNonAdmin()
  {
    global $current_user;
    get_currentuserinfo();
    if (
      user_can($current_user, 'editor') ||
      user_can($current_user, 'author') ||
      user_can($current_user, 'contributor') ||
      user_can($current_user, 'subscriber')
    ) {
      echo '<style>.updated, .error, .update-nag{display:none !important}</style>';
    };
  }

  public function restrictAdminPannelForNonAdmin()
  {
    if (
      is_admin() &&
      !defined('DOING_AJAX') &&
      (current_user_can('subscriber') || current_user_can('contributor'))
    ) {
      wp_redirect(home_url());
      exit;
    }
  }
}
