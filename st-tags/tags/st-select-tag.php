<?php

/**
 * Simple settings
 *
 * @copyright Copyright 2013 Fredrik Forsmo (http://forsmo.me)
 * @license The MIT License
 */

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

if (!class_exists('ST_Select_Tag')):

class ST_Select_Tag extends ST_Tag {

  /**
   * Select constructor.
   *
   * @since 1.0
   */

  public function __construct (array $attributes = array()) {
    $options = array();
    $selected = '';

    if (isset($attributes['options'])) {
      $options = $attributes['options'];
      unset($attributes['options']);
    }
    if (isset($attributes['selected'])) {
      $selected = $attributes['selected'];
      unset($attributes['selected']);
    }

    parent::__construct($attributes);

    $this->setTag('<select', '>', '</select>');
    $this->optionTags($options, $selected);
  }

  /**
   * Add <option> tags to the select.
   *
   * @param array $options
   * @since 1.0
   */

  public function optionTags (array $options = array(), $selected = '') {
    $html = '';
    $tag = new ST_Tag();
    $tag->setTag('<option', '>', '</option>');
    foreach ($options as $opt) {
      $tag->reset();
      if (isset($opt['html'])) {
        $tag->setHtml($opt['html']);
        unset($opt['html']);
      }
      $tag->setAttributes($opt);
      if ($opt['value'] === $selected) {
        $tag->setAttribute('selected', 'selected');
      }
      $html .= $tag->render();
    }
    $this->setHtml($html);
  }

}

endif;