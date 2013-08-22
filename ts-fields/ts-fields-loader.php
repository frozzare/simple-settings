<?php

/**
 * Theme settings
 *
 * @copyright Copyright 2013 Fredrik Forsmo (http://forsmo.me)
 * @license The MIT License
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

// Check so class don't exists before we creat it.
if (!class_exists('TS_Fields_Loader')):

class TS_Fields_Loader {

  /**
   * Construct.
   *
   * @since 1.0
   */

  public function __construct () {
    $this->setup_globals();
    $this->includes();
    $this->setup_actions();
  }

  /**
   * Setup globals.
   *
   * @since 1.0
   * @access private
   */

  private function setup_globals () {
    $ts = theme_settings();
    $this->fields_dir = trailingslashit($ts->plugin_dir . 'ts-fields');
    $this->field_types_dir = trailingslashit($this->fields_dir) . 'fields/';
  }

  /**
   * Includes.
   *
   * @since 1.0
   * @access private
   */

  private function includes () {
    require($this->fields_dir . 'ts-tag.php');
    require($this->fields_dir . 'ts-input-field.php');
    require($this->field_types_dir . 'ts-input-text.php');
  }

  /**
   * Setup actions.
   *
   * @since 1.0
   * @access private
   */

  private function setup_actions () {
  }

}

function ts_fields () {
  new TS_Fields_Loader();
}

endif;
