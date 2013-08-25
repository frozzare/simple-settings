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
    require($this->page_dir . 'ts-functions.php');
    require($this->page_dir . 'ts-page-class.php');
    require($this->page_dir . 'ts-page-admin.php');
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

new TS_Page_Loader();

endif;
