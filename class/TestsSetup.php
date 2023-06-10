<?php

class TestsSetup
{
  function __construct()
  {
    add_filter('site_status_tests', [$this, 'disableWPHealthTests']);
  }

  public function disableWPHealthTests($tests)
  {
    unset($tests['direct']['wordpress_version']);
    unset($tests['direct']['plugin_version']);
    unset($tests['direct']['theme_version']);
    unset($tests['direct']['php_version']);
    unset($tests['direct']['php_extensions']);
    unset($tests['direct']['sql_server']);
    unset($tests['direct']['utf8mb4_support']);
    unset($tests['direct']['https_status']);
    unset($tests['direct']['ssl_support']);
    unset($tests['direct']['scheduled_events']);
    unset($tests['direct']['http_requests']);
    unset($tests['direct']['is_in_debug_mode']);
    unset($tests['direct']['rest_availability']);
    unset($tests['async']['dotorg_communication']);
    unset($tests['async']['background_updates']);
    unset($tests['async']['loopback_requests']);
    return $tests;
  }
}
