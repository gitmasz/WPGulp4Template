<?php

class FeedSetup
{
  function __construct()
  {
    add_action('do_feed', [$this, 'disableFeed']);
    add_action('do_feed_rdf', 'disable_feed', 1);
    add_action('do_feed_rss', 'disable_feed', 1);
    add_action('do_feed_rss2', 'disable_feed', 1);
    add_action('do_feed_atom', 'disable_feed', 1);
    add_action('do_feed_rss2_comments', 'disable_feed', 1);
    add_action('do_feed_atom_comments', 'disable_feed', 1);
  }

  public function disableFeed()
  {
    wp_die(__('No channel available!'));
  }
}
