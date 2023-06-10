<?php

class AttachmentsSetup
{
  function __construct()
  {
    add_action('template_redirect', [$this, 'redirectAttachment']);
    add_action('admin_init', [$this, 'changeImageLinkDefaultSetup'], 10);
    add_action('print_media_templates', [$this, 'hideAttachmentLink']);
  }

  public function redirectAttachment()
  {
    if (is_attachment()) {
      global $wp_query;
      $wp_query->set_404();
      status_header(404);
    }
  }

  public function changeImageLinkDefaultSetup()
  {
    $image_set = get_option('image_default_link_type');

    if ($image_set !== 'none') {
      update_option('image_default_link_type', 'none');
    }
  }

  public function hideAttachmentLink()
  {
    echo '<style>select.link-to option[value="post"]{display:none;}</style>';
  }
}
