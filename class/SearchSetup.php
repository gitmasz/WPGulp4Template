<?php

class SearchSetup
{
  function __construct()
  {
    add_action('parse_query', [$this, 'disableSearchFunctionality']);
    add_filter('get_search_form', '__return_null');
    add_action('widgets_init', [$this, 'removeSearchWidget']);
    add_filter('pre_get_posts', [$this, 'setSearchFilter']);
  }

  public function disableSearchFunctionality($query, $error = true)
  {
    if (is_search()) {
      $query->is_search = false;
      if ($error == true) {
        $query->is_404 = true;
      }
    }
  }

  public function removeSearchWidget()
  {
    unregister_widget('WP_Widget_Search');
  }

  public function setSearchFilter($query)
  {
    if ($query->is_search) {
      $query->set('post_type', array('post'));
    };
    return $query;
  }
}
