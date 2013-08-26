<?php

/**
 * Simple settings
 *
 * @copyright Copyright 2013 Fredrik Forsmo (http://forsmo.me)
 * @license The MIT License
 */

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

if (!class_exists('ST_Tag')):

class ST_Tag {

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
   * End of the start tag.
   *
   * @var string
   */

  private $tag_start_end = '';

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
   * Tag constructor.
   *
   * @param array $attributes
   *
   * @since 1.0
   */

  public function __construct (array $attributes = array()) {
    if (isset($attributes['html'])) {
      $this->setHtml($attributes['html']);
      unset($attributes['html']);
    }
    $this->setAttributes($attributes);
  }

  /**
   * Reset attributes array and html string.
   *
   * @param bool tag
   *
   * @since 1.0
   */

   public function reset ($tag = false) {
     $this->attributes = array();
     $this->html = '';
     if ($tag) {
       $this->tag_start = '';
       $this->tag_start_end = '';
       $this->tag_end = '';
     }
   }

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

  public function setTag ($start = '', $start_end = '', $end = '') {
    if (is_null($end)) {
      $end = $start_end;
      $start_end = null;
    }

    $this->tag_start = $start . ' ';
    $this->tag_start_end = $start_end;
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
   * @since 1.0
   *
   * @return string
   */

  public function render () {
    $attributes = '';
    /*if (!is_string($this->attributes['class']
      && in_array($this->attributes['type'], array('text')))) {
      $this->setAttribute('class', 'regular-text');
    }*/
    foreach ($this->attributes as $key => $value) {
      if (is_string($key)) {
        if ($key == 'name') $value = starialize($value);
        $attributes .= $key .= '="' . $value . '"';
      }
    }
    $tag = $this->tag_start . $attributes;
    if (!is_null($this->tag_start_end)) {
      $tag .= $this->tag_start_end;
      if (!is_null($this->html)) {
        $tag .= $this->html;
      }
    }
    return $tag . $this->tag_end;
  }

  /**
   * Output html tag.
   *
   * @since 1.0
   *
   * @return string
   */

  public function display () {
    echo $this->render();
  }
}

endif;
