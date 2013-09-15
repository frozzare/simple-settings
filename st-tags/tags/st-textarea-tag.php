<?php

/**
 * Simple settings
 *
 * @copyright Copyright 2013 Fredrik Forsmo (http://forsmo.me)
 * @license The MIT License
 */

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

if (!class_exists('ST_Textarea_Tag')):

class ST_Textarea_Tag extends ST_Tag {

  /**
   * Textarea constructor.
   *
   * @since 1.0
   */

  public function __construct (array $attributes = array()) {
    parent::__construct($attributes);
    if (!isset($attributes['class'])) {
      $this->setAttribute('class', 'large-text');
    }
    if (!isset($attributes['rows'])) {
      $this->setAttribute('rows', 10);
    }
    if (!isset($attributes['cols'])) {
      $this->setAttribute('cols', 50);
    }
    $this->setTag('<textarea', '>', '</textarea>');
  }

}

endif;