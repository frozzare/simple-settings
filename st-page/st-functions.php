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
 * Get option.
 *
 * @param string $option
 * @param string $default
 * @since 1.0
 *
 * @return mixed
 */

function st_get_option ($option, $default = '') {
  $option = starialize($option);
  return get_option($option, $default);
}

/**
 * Update option.
 *
 * @param string $option
 * @param string $new_value
 * @since 1.0
 *
 * @return bool
 */

function st_update_option ($option, $new_value = '') {
  $option = starialize($option);
  return update_option($option, $new_value);
}

/**
 * Delete option.
 *
 * @param string $option
 * @since 1.0
 *
 * @return bool
 */

function st_delete_option ($option) {
  $option = starialize($option);
  return delete_option($option);
}