<?php

/**
 * Simple settings
 *
 * @copyright Copyright 2013 Fredrik Forsmo (http://forsmo.me)
 * @license The MIT License
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

// Check so class don't exists before we creat it.
if (!class_exists('ST_Page_Loader')):

class ST_Page_Loader {

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
    $st = simple_settings();
    $this->page_dir = trailingslashit($st->plugin_dir . 'st-page');
  }

  /**
   * Includes.
   *
   * @since 1.0
   * @access private
   */

  private function includes () {
    require($this->page_dir . 'st-functions.php');
    require($this->page_dir . 'st-page-class.php');
    require($this->page_dir . 'st-page-admin.php');
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

new ST_Page_Loader();

endif;
