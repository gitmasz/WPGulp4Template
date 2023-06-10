<?php

class TaxonomySetup
{
  function __construct()
  {
    add_filter('init', [$this, 'addDefaultTaxonomyToPageType']);
    // add_filter( 'init', [$this, 'addCustomTaxonomy'] );
    // add_filter( 'init', [$this, 'removeCustomTaxonomy'] );
  }

  public function addDefaultTaxonomyToPageType()
  {
    register_taxonomy_for_object_type('post_tag', 'page');
    register_taxonomy_for_object_type('category', 'page');
  }

  public function addCustomTaxonomy()
  {
    $games_labels = array(
      'name' => _x('Games', 'taxonomy general name'),
      'singular_name' => _x('Game', 'taxonomy singular name'),
      'search_items' =>  __('Find game'),
      'all_items' => __('All games'),
      'parent_item' => __('Game parent'),
      'parent_item_colon' => __('Game parent:'),
      'edit_item' => __('Edit game'),
      'update_item' => __('Update game'),
      'add_new_item' => __('Add game'),
      'new_item_name' => __('Game name'),
      'menu_name' => __('Games'),
    );
    $games_args = array(
      'labels' => $games_labels,
      'hierarchical' => false,
      'show_in_rest' => true,
      'show_ui' => true,
      'show_admin_column' => true,
      'update_count_callback' => '_update_post_term_count',
      'query_var' => true,
      'rewrite' => array(
        'slug' => 'game',
        'hierarchical' => false,
      ),
    );
    register_taxonomy('games', array('games', 'post', 'page'), $games_args);
  }

  public function removeCustomTaxonomy()
  {
    unregister_taxonomy('games');
  }
}
