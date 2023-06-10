<?php

class CustomPostTypeSetup
{
  function __construct()
  {
    add_filter('init', [$this, 'addCustomPostType']);
    // add_filter( 'init', [$this, 'removeCustomPostType'] );
  }

  public function addCustomPostType()
  {
    $games_labels = array(
      'name' => _x('Games', 'Post type general name'),
      'singular_name' => _x('Game', 'Post type singular name'),
      'menu_name' => _x('Games', 'Admin Menu text'),
      'name_admin_bar' => _x('Game', 'Add New on Toolbar'),
      'add_new' => __('Add game'),
      'add_new_item' => __('Add new game'),
      'new_item' => __('New game'),
      'edit_item' => __('Edit game'),
      'view_item' => __('View game'),
      'all_items' => __('All games'),
      'search_items' => __('Find game'),
      'parent_item_colon' => __('Parent game:'),
      'not_found' => __('No games found.'),
      'not_found_in_trash' => __('No games found in trash.'),
      'featured_image' => __('Game featured image'),
      'set_featured_image' => __('Add game featured image'),
      'remove_featured_image' => __('Remove game featured image'),
      'use_featured_image' => __('Use as game featured image'),
      'archives' => __('Games archive'),
      'insert_into_item' => __('Add to game'),
      'uploaded_to_this_item' => __('Upload to game'),
      'filter_items_list' => __('Filter games list'),
      'items_list_navigation' => __('Games list navigation'),
      'items_list' => __('Games list'),
    );
    $games_args = array(
      'labels' => $games_labels,
      'public' => true,
      'hierarchical' => false,
      'publicly_queryable' => true,
      'exclude_from_search' => false,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_nav_menus' => true,
      'show_in_admin_bar' => true,
      'show_in_rest' => true,
      'menu_position' => 4,
      'menu_icon' => 'dashicons-games', // Custom icon: 'data:image/svg+xml;base64,'
      'capability_type' => 'post',
      'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt'),
      'has_archive' => false,
      'rewrite' => array('slug' => 'game'),
      'query_var' => true,
    );
    register_post_type('games', $games_args);
  }

  public function removeCustomPostType()
  {
    unregister_post_type('games');
  }
}
