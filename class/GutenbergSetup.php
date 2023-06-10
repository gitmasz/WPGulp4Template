<?php

class GutenbergSetup
{
  function __construct()
  {
    add_filter('allowed_block_types_all', [$this, 'allowedBlockTypes'], 25, 2);
    add_filter('after_setup_theme', [$this, 'disableBlockPatterns']);
  }

  public function allowedBlockTypes()
  {
    return array(
      'core/heading',
      'core/paragraph',
      'core/quote',
      'core/image',
      'core/list',
      'core/list-item',
      'core/gallery',
      'core/video',
      'core/buttons',
      'core/separator',
      'core/spacer'
    );
  }

  public function disableBlockPatterns()
  {
    remove_theme_support('core-block-patterns');
  }
}
