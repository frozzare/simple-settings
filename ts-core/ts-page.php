<?php

/**
 * Theme settings
 *
 * @copyright Copyright 2013 Fredrik Forsmo (http://forsmo.me)
 * @license The MIT License
 */

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

if (!class_exists('TS_Page')):

class TS_Page {

  public function __construct (array $options = array()) {
    $this->add_sub_page($options);
    $this->setup_globals();
    $this->load_tabs();
    $this->collect_methods();
  }

  /**
   * Setup globals.
   *
   * @since 1.0
   * @access private
   */

  private function setup_globals () {

  }

  /**
   * Collect all public methods from the class.
   *
   * @param object $klass
   * @since 1.0
   * @access private
   *
   * @return array
   */

  private function collect_methods ($klass) {
    $tab_methods = get_class_methods($klass);
    $parent_methods = get_class_methods(get_parent_class($klass));
    return array_diff($tab_methods, $parent_methods);
   //return array();
  }

  /**
   * Load tabs.
   *
   * @since 1.0
   * @access private
   */

  private function load_tabs () {
    if (!defined('TS_PAGE_PATH')) {
      // define some default
      define('TS_PAGE_PATH', dirname(__FILE__) . '/../ideas/');
    }


    if (!class_exists('General')) {
      // strange error...
      require (TS_PAGE_PATH . 'general-page.php');
      $name = basename(TS_PAGE_PATH . 'general-page.php', '.php');
      $name = str_replace('-page', '', $name);
      $name = ucfirst($name);
      $klass = new $name;
      $methods = $this->collect_methods($klass);
      foreach ($methods as $method) {
        $this->create_field($klass->$method());
      }

    }

  }

  /**
   * Add sub page.
   *
   * @since 1.0
   * @access private
   */

  private function add_sub_page (array $options = array()) {
    $options = (object)$options;
    $slug = ts_slug($options->name);
    //add_submenu_page('options.php', $options->name, $options->name, 'manage_options', $slug, array($this, 'page_callback'));
  }

  /**
   * Callback
   *
   * @since 1.0
   * @access private
   */

  private function page_callback () {}

  private function create_field (array $options = array()) {
  }
}

endif;

$ts_page = new TS_Page;