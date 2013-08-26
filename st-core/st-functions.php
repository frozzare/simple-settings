<?php

/**
 * Simple settings
 *
 * @copyright Copyright 2013 Fredrik Forsmo (http://forsmo.me)
 * @license The MIT License
 */

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

/**
 * Make a slug.. might not keep this function.
 *
 * @param string $text
 *
 * @return string
 */

function st_slug ($text) {
  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
  $text = trim($text, '-');
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  $text = strtolower($text);
  $text = preg_replace('~[^-\w]+~', '', $text);
  return empty($text) ? '' : $text;
}

/**
 * Add `st_` to the beginning of the string if it don't exists
 * or return just `st_`.
 *
 * @param string $str
 * @since 1.0
 *
 * @return string
 */

function starialize ($str = null) {
  if (!is_null($str)) {
    if (strpos($str, 'st_') === false) {
      $str = 'st_' . $str;
    }
    return $str;
  }
  return 'st_';
}
