<?php

/**
 * Theme settings
 *
 * @copyright Copyright 2013 Fredrik Forsmo (http://forsmo.me)
 * @license The MIT License
 */

add_action('admin_menu',            'ts_admin_menu');
add_action('admin_init',            'ts_admin_init');
add_action('admin_head',            'ts_admin_head');
add_action('admin_enqueue_scripts', 'ts_enqueue_scripts');

/**
 * Admin menu action.
 */

function ts_admin_menu () {
  do_action('ts_admin_menu');
}

/**
 * Admin init action.
 */

function ts_admin_init () {
  do_action('ts_admin_init');
}

/**
 * Admin head action.
 */

function ts_admin_head () {
  do_action('ts_admin_head');
}

/**
 * Enqueue scripts action.
 */

function ts_enqueue_scripts () {
  do_action('ts_enqueue_scripts');
}