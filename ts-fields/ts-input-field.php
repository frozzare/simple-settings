<?php

/**
 * Theme settings
 *
 * @copyright Copyright 2013 Fredrik Forsmo (http://forsmo.me)
 * @license The MIT License
 */

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

if (!class_exists('TS_Input_Field')):

class TS_Input_Field extends TS_Tag {

  /**
   * Common attributes.
   *
   * @var array
   */

  private $attributes = array('type', 'name', 'class', 'placeholder', 'value');

  /**
   * Empty construct.
   *
   * @since 1.0
   */

  public function __construct () {
    $this->setAttributes($this->attributes);
  }
}

endif;