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
if (!class_exists('TS_Tags_Loader')):

class TS_Tags_Loader {

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
    $this->tags_dir = trailingslashit($ts->plugin_dir . 'ts-tags');
  }

  /**
   * Includes.
   *
   * @since 1.0
   * @access private
   */

  private function includes () {
    require($this->tags_dir . 'ts-tag.php');
    foreach (glob($this->tags_dir . 'tags/*') as $file) {
      require($file);
    }
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

new TS_tags_Loader();

endif;
