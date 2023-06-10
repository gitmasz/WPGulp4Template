<?php

class TranslationSetup
{
  function __construct()
  {
    add_action('after_setup_theme', [$this, 'addTranslationSupport']);
  }

  public function addTranslationSupport()
  {
    load_theme_textdomain('gulp4-theme', get_template_directory() . '/languages');
  }
}
