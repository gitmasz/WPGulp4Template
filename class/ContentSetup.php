<?php

class ContentSetup
{
  function __construct()
  {
    remove_filter('term_description', 'wpautop');
    add_filter('the_content', [$this, 'removeEmptyParagraphsAndLines']);
  }

  public function removeEmptyParagraphsAndLines($content)
  {
    $content = preg_replace(array(
      '#<p>\s*<(div|aside|section|article|header|footer)#',
      '#<\/(div|aside|section|article|header|footer)>\s*<\/p>#',
      '#<\/(div|aside|section|article|header|footer)>\s*<br ?\/?>#',
      '#<(div|aside|section|article|header|footer)(.*?)>\s*<\/p>#',
      '#<p>\s*<\/(div|aside|section|article|header|footer)#',
      '#\s\s#',
      '#>(?<!strong>|em>|a>|sub>|sup>|code>|mark>|kbd>|s>)\s*#',
      '#\s*<\/#',
    ), array(
      '<$1',
      '</$1>',
      '</$1>',
      '<$1$2>',
      '</$1',
      '',
      '$1>',
      '</$1',
    ), $content);
    return preg_replace('#<p>(\s|&nbsp;)*+(<br\s*\/*>)*(\s|&nbsp;)*<\/p>#i', '', $content);
  }
}
