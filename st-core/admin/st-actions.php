<?php

/**
 * Simple settings
 *
 * @copyright Copyright 2013 Fredrik Forsmo (http://forsmo.me)
 * @license The MIT License
 */

add_action('admin_menu',            'st_admin_menu');
add_action('admin_init',            'st_admin_init');
add_action('admin_head',            'st_admin_head');
add_action('admin_enqueue_scripts', 'st_admin_enqueue_scripts');
add_action('admin_footer',          'st_admin_footer');

/**
 * Admin menu action.
 *
 * @since 1.0
 */

function st_admin_menu () {
  do_action('st_admin_menu');
}

/**
 * Admin init action.
 *
 * @since 1.0
 */

function st_admin_init () {
  do_action('st_admin_init');
}

/**
 * Admin head action.
 *
 * @since 1.0
 */

function st_admin_head () {
  do_action('st_admin_head');
}

/**
 * Enqueue scripts action.
 *
 * @since 1.0
 */

function st_admin_enqueue_scripts () {
  do_action('st_admin_enqueue_scripts');
}

/**
 * Admin footer action.
 *
 * @since 1.0
 */

function st_admin_footer () {
  do_action('st_admin_footer');
}