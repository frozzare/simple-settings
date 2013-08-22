<?php

/**
 * Theme settings
 *
 * @copyright Copyright 2013 Fredrik Forsmo (http://forsmo.me)
 * @license The MIT License
 */

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

if (!class_exists('TS_Tag')):

class TS_Tag {

  /**
   * Attributes.
   *
   * @var array
   */

  private $attributes = array();

  /**
   * Start of the tag.
   *
   * @var string
   */

  private $tag_start = '';

  /**
   * End of the tag.
   *
   * @var string
   */

  private $tag_end = '';

  /**
   * HTML inside the tag.
   *
   * @var string
   */

  private $html = '';

  /**
   * Set attributes.
   *
   * @param array $attributes
   *
   * @since 1.0
   */

  public function setAttributes ($attributes) {
    $this->attributes = array_merge($this->attributes, $attributes);
  }

  /**
   * Set attribute.
   *
   * @param string $key
   * @param string $value
   *
   * @since 1.0
   */

  public function setAttribute ($key, $value) {
    $this->attributes[$key] = $value;
  }

  /**
   * Get attributes.
   *
   * @since 1.0
   *
   * @return array
   */

  public function getAttributes (array $attributes = array()) {
    return empty($attributes) ? $this->attributes
      : array_filter(function ($attribute) {
        if (in_array($attribute, $attributes)) {
          return $attribute;
        }
      }, $this->attributes);
  }

  /**
   * Get attribute.
   *
   * @since 1.0
   *
   * @return mixed
   */

  public function getAttribute ($key) {
    if (isset($this->attributes[$key])) {
      return $this->attributes[$key];
    }
  }

  /**
   * Set HTML for tag.
   *
   * @param string $html
   * @since 1.0
   */

  public function setTag ($start, $end) {
    $this->tag_start = $start . ' ';
    $this->tag_end = $end;
  }

  /**
   * Set HTML.
   *
   * @param string $content
   * @since 1.0
   */

  public function setHtml ($html) {
    $this->html = $html;
  }

  /**
   * Get HTML.
   *
   * @since 1.0
   *
   * @return string
   */

  public function getHTML () {
    return $this->html;
  }

  /**
   * Render html tag.
   *
   * @param string $content
   * @since 1.0
   *
   * @return string
   */

  public function render () {
    $attributes = '';
    foreach ($this->attributes as $key => $value) {
      if (is_string($key)) {
        $attributes .= $key .= '="' . $value . '"';
      }
    }
    return $this->tag_start . $attributes . $this->tag_end;
  }
}

endif;
