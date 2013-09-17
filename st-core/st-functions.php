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

/**
 * Add whitespace before and/or after the given string.
 *
 * @param string $str
 * @param bool $before Default true
 * @param bool $after Default false
 * @param int $length Length of the whitespace, both before and after length. Default 1.
 * @since 1.0
 *
 * @return string
 */

function st_whitespace ($str = '', $before = true, $after = false, $length = 1) {
  if (!is_null($str) && !empty($str)) {
    $whitespace = '';
    for ($i = 0; $i < $length; $i++) $whitespace .= ' ';
    return ($before ? $whitespace : '') . $str . ($after ? $whitespace : '');
  }
  return $str;
}