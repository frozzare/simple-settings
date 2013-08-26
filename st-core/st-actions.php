<?php

/**
 * This file contains actions and filters that are used through-out Simple settings.
 */

// @todo make more internal actions like in campsite

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

add_action('plugins_loaded',    'st_loaded', 10);
add_action('after_setup_theme', 'st_after_setup_theme', 10);

if (is_admin()) {
  add_action('st_loaded', 'st_admin');
}

/**
 * Plugins loaded action.
 */

function st_loaded () {
  do_action('st_loaded');
}

/**
 * After setup theme action.
 */

function st_after_setup_theme () {
  do_action('st_after_setup_theme');
}