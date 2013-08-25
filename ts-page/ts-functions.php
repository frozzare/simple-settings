<?php

/**
 * Theme settings
 *
 * @copyright Copyright 2013 Fredrik Forsmo (http://forsmo.me)
 * @license The MIT License
 */

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

/**
 * Get option.
 *
 * @param string $option
 * @param string $default
 * @since 1.0
 *
 * @return mixed
 */

function ts_get_option ($option, $default = '') {
  $option = tsarialize($option);
  return get_option($option, $default);
}

/**
 * Update option.
 *
 * @param string $option
 * @param string $new_value
 * @since 1.0
 *
 * @return boolean
 */

function ts_update_option ($option, $new_value = '') {
  $option = tsarialize($option);
  return update_option($option, $new_value);
}

/**
 * Delete option.
 *
 * @param string $option
 * @since 1.0
 *
 * @return boolean
 */

function ts_delete_option ($option) {
  $option = tsarialize($option);
  return delete_option($option);
}