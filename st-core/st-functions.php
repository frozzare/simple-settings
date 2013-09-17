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
