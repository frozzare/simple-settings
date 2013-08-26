<?php

/**
 * Simple settings
 *
 * @copyright Copyright 2013 Fredrik Forsmo (http://forsmo.me)
 * @license The MIT License
 */

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

if (!class_exists('ST_Input_Tag')):

class ST_Input_Tag extends ST_Tag {

  /**
   * Input construct.
   *
   * @since 1.0
   */

  public function __construct (array $attributes = array()) {
    parent::__construct($attributes);
    $this->setAttribute('class', 'regular-text');
    $this->setTag('<input', '/>');
  }
}

endif;