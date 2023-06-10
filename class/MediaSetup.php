<?php

class MediaSetup
{
  function __construct()
  {
    add_theme_support('post-thumbnails');
    // add_image_size('thumbnail', 360, 180, true);
    // add_image_size('medium', 780, 390, true);
    // add_image_size('large', 2000, 1000, true);
    add_filter('intermediate_image_sizes_advanced', '__return_empty_array');
    add_filter('big_image_size_threshold', '__return_false');
    add_filter('wp_get_attachment_url', [$this, 'forceHttpsForMedia']);
  }

  public function forceHttpsForMedia($url)
  {
    if (is_ssl()) {
      $url = str_replace('http://', 'https://', $url);
      return $url;
    }
  }
}
