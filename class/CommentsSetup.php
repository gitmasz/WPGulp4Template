<?php

class CommentsSetup
{
  function __construct()
  {
    add_filter('comment_class', [$this, 'removeCommentAuthorClass']);
    add_action('admin_init', [$this, 'disableComments']);
    add_filter('comments_open', '__return_false', 20, 2);
    add_filter('pings_open', '__return_false', 20, 2);
    add_filter('comments_array', '__return_empty_array', 10, 2);
    add_action('admin_menu', [$this, 'removeAdminMenuComments']);
    add_action('init', [$this, 'removeAdminBarMenuComments']);
  }

  public function removeCommentAuthorClass($classes)
  {
    foreach ($classes as $key => $class) {
      if (strstr($class, 'comment-author-')) {
        unset($classes[$key]);
      }
      if (strstr($class, 'byuser')) {
        unset($classes[$key]);
      }
      if (strstr($class, 'bypostauthor')) {
        unset($classes[$key]);
      }
    }
    return $classes;
  }

  public function disableComments()
  {
    global $pagenow;
    if ($pagenow === 'edit-comments.php' || $pagenow === 'comment.php') {
      wp_redirect(admin_url());
      exit;
    }
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
    foreach (get_post_types() as $post_type) {
      if (post_type_supports($post_type, 'comments')) {
        remove_post_type_support($post_type, 'comments');
        remove_post_type_support($post_type, 'trackbacks');
      }
    }
  }

  public function removeAdminMenuComments()
  {
    remove_menu_page('edit-comments.php');
  }

  public function removeAdminBarMenuComments()
  {
    if (is_admin_bar_showing()) {
      remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
  }
}
