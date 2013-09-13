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
   * Input fields that act like a normal text input.
   *
   * @var array
   */

  private $textFieldLiked = array('text', 'url', 'email', 'number', 'search', 'password');

  /**
   * Input construct.
   *
   * @since 1.0
   */

  public function __construct (array $attributes = array()) {
    parent::__construct($attributes);
    if (in_array($this->getAttribute('type'), $this->textFieldLiked)) {
      $this->setAttribute('class', 'regular-text');
    }
    $this->setTag('<input', '/>');
  }
}

endif;