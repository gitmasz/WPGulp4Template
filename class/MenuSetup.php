<?php

class MenuSetup
{
  function __construct()
  {
    add_action('init', [$this, 'registerMenu']);
  }

  public function registerMenu()
  {
    register_nav_menus(
      array(
        'main-menu' => __('Main menu'),
      )
    );
  }
}
