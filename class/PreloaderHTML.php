<?php

class PreloaderHTML
{
  private string $preloaderCSS;

  public function addPreloader()
  {
    $this->preloaderCSS = dirname(__DIR__) . '\css\preloader.min.css';
    if (file_exists($this->preloaderCSS)) {
      echo '<style>' . file_get_contents($this->preloaderCSS) . '</style>'
        . '<div id="preloader"><div id="status"><div class="dots_animated"><div></div><div></div><div></div><div></div></div></div></div>';
    }
  }
}
