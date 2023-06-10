<?php

class CleanUpSetup
{
  function __construct()
  {
    add_filter('wp_sitemaps_enabled', '__return_false');
    remove_action('wp_head', 'wp_resource_hints', 2); // Disable dns-prefetch
    remove_action('wp_head', 'wp_generator');
    add_filter('the_generator', '__return_false');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('template_redirect', 'rest_output_link_header', 11);
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    add_action('widgets_init', [$this, 'removeRecentCommentsStyle']);
    add_action('init', [$this, 'removeDefaultPosts']);
  }

  public function removeRecentCommentsStyle()
  {
    global $wp_widget_factory;
    remove_action('wp_head', array(
      $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
      'recent_comments_style'
    ));
  }

  public function removeDefaultPosts()
  {
    wp_delete_post(1, true);
    wp_delete_post(2, true);
    wp_delete_post(3, true);
  }
}
