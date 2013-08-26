<?php

/**
 * Simple settings
 *
 * @copyright Copyright 2013 Fredrik Forsmo (http://forsmo.me)
 * @license The MIT License
 */

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

if (!class_exists('ST_Label_Tag')):

class ST_Label_Tag extends ST_Tag {

  /**
   * Label constructor.
   *
   * @since 1.0
   */

  public function __construct (array $attributes = array()) {
    if (isset($attributes['for'])) {
      $attributes['for'] = starialize($attributes['for']);
    }
    parent::__construct($attributes);
    $this->setTag('<label', '>', '</label>');
  }

}

endif;