<?php

/**
 * Simple settings
 *
 * @copyright Copyright 2013 Fredrik Forsmo (http://forsmo.me)
 * @license The MIT License
 */

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

if (!class_exists('ST_Span_Tag')):

class ST_Span_Tag extends ST_Tag {

  /**
   * Span constructor.
   *
   * @since 1.0
   */

  public function __construct ($html = '') {
    $this->setTag('<span', '>', '</span>');
    $this->setHtml($html);
  }

}

endif;