<?php

/**
 * Theme settings
 *
 * @copyright Copyright 2013 Fredrik Forsmo (http://forsmo.me)
 * @license The MIT License
 */

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

if (!class_exists('TS_Label_Tag')):

class TS_Label_Tag extends TS_Tag {

  /**
   * Label constructor.
   *
   * @since 1.0
   */

  public function __construct (array $attributes = array()) {
    if (isset($attributes['for'])) {
      $attributes['for'] = tsarialize($attributes['for']);
    }
    parent::__construct($attributes);
    $this->setTag('<label', '>', '</label>');
  }

}

endif;