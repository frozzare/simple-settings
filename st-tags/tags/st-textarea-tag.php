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
    $this->setTag('<textarea', '>', '</textarea>');
  }

}

endif;