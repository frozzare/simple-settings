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
if (!class_exists('TS_Page_Loader')):

class TS_Page_Loader {

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
    $this->page_dir = trailingslashit($ts->plugin_dir . 'ts-page');
  }

  /**
   * Includes.
   *
   * @since 1.0
   * @access private
   */

  private function includes () {
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

function ts_page () {
  new TS_Page_Loader();
}

endif;
