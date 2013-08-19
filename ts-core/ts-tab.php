<?php

/**
 * Theme settings
 *
 * @copyright Copyright 2013 Fredrik Forsmo (http://forsmo.me)
 * @license The MIT License
 */

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

if (!class_exists('TS_Tab')):

class TS_Tab {

  public function __construct (array $options = array()) {
    $this->setup_globals();
    $this->load_tabs();
    $this->collect_methods();
  }

  /**
   * Setup globals.
   *
   * @since 1.0
   * @access private
   *
   * @return void
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
  }

  /**
   * Load tabs.
   *
   * @since 1.0
   * @access private
   *
   * @return void
   */

  private function load_tabs () {
    if (!defined('TS_TABS_PATH')) {
      // define some default
      define('TS_TABS_PATH', dirname(__FILE__) . '/../ideas/');
    }

    if (!class_exists('Colors')) {
      // strange error...
      require (TS_TABS_PATH . 'colors-tab.php');
      $name = basename(TS_TABS_PATH . 'colors-tab.php', '.php');
      $name = str_replace('-tab', '', $name);
      $name = ucfirst($name);
      $klass = new $name;
      $methods = $this->collect_methods($klass);
      var_dump($methods);
    }
  }
}

endif;

$ts_tab = new TS_Tab;