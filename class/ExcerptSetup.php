<?php

class ExcerptSetup
{
  function __construct()
  {
    add_action('excerpt_length', [$this, 'setExcerptLength']);
    add_action('init', [$this, 'addExcerptToPageType']);
  }

  public function setExcerptLength()
  {
    return 20;
  }

  public function addExcerptToPageType()
  {
    add_post_type_support('page', 'excerpt');
  }
}
