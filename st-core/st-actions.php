<?php

/**
 * This file contains actions and filters that are used through-out Simple settings.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

add_action('plugins_loaded',    'st_loaded', 10);
add_action('after_setup_theme', 'st_after_setup_theme', 10);

add_action('init', 'simple_settings_init');

if (is_admin()) {
  add_action('st_loaded', 'st_admin');
}

/**
 * Plugins loaded action.
 *
 * @since 1.0
 */

function st_loaded () {
  do_action('st_loaded');
}

/**
 * After setup theme action.
 *
 * @since 1.0
 */

function st_after_setup_theme () {
  do_action('st_after_setup_theme');
}

/**
 * Simple settings instance options action.
 *
 * @since 1.0
 */

function simple_settings_init () {
  do_action('simple_settings_init');
}