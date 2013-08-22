<?php

/**
 * This file contains actions and filters that are used through-out Theme settings.
 */

// @todo make more internal actions like in campsite

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

add_action('plugins_loaded',    'ts_loaded', 10);
add_action('after_setup_theme', 'ts_after_setup_theme', 10);

if (is_admin()) {
  add_action('ts_loaded', 'ts_admin');
}

/**
 * Plugins loaded action.
 */

function ts_loaded () {
  do_action('ts_loaded');
}

/**
 * After setup theme action.
 */

function ts_after_setup_theme () {
  do_action('ts_after_setup_theme');
}