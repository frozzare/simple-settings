<?php

/**
 * Simple Settings
 *
 * @copyright Copyright 2013 Fredrik Forsmo (http://forsmo.me)
 * @license The MIT License
 */

/**
 * Plugin Name: Simple Settings
 * Description: Simple Settings page
 * Author: Fredrik Forsmo
 * Author URI: http://forsmo.me/
 * Version: 1.0
 * Plugin URI: https://github.com/frozzare/simple-settings
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

// Check so class don't exists before we creat it.
if (!class_exists('Simple Settings')):

/**
 * Simple Settings class.
 *
 * Tap tap tap... Is this thing on?
 *
 * @since 1.0
 */

class Simple_Settings {

  /**
   * The instance of Simple Settings
   *
   * @since 1.0
   *
   * @var object
   */

  private static $instance;

  /**
   * Main Theme Settings instance.
   *
   * @since 1.0
   *
   * @return The instance of Simple Settings
   */

  public static function instance () {
    if (!isset(self::$instance)) {
      self::$instance = new Simple_Settings;
      self::$instance->constants();
      self::$instance->setup_globals();
      self::$instance->includes();
      // self::$instance->setup_requried();
      self::$instance->setup_actions();
    }
    return self::$instance;
  }

  /**
   * Construct. Nothing to see.
   *
   * @since 1.0
   * @access private
   */

  private function __construct () {}

  /**
   * Bootstrap constants
   *
   * @since 1.0
   * @access private
   */

  private function constants () {
    // Path to Simple settings plugin directory
    if (!defined('ST_PLUGIN_DIR')) {
      define('ST_PLUGIN_DIR', trailingslashit(WP_PLUGIN_DIR . '/simple-settings'));
    }

    // URL to Simple settings plugin directory
    if (!defined('ST_PLUGIN_URL')) {
      $plugin_url = plugin_dir_url(__FILE__);

      if (is_ssl()) {
        $plugin_url = str_replace('http://', 'https://', $plugin_url);
      }

      define('ST_PLUGIN_URL', $plugin_url);
    }
  }

  /**
   * Include files.
   *
   * @since 1.0
   * @access private
   */

  private function includes () {
    require ($this->plugin_dir . 'st-core/st-functions.php');
    require ($this->plugin_dir . 'st-core/st-admin.php');
    require ($this->plugin_dir . 'st-core/st-actions.php');
    require ($this->plugin_dir . 'st-tags/st-tags-loader.php');
    require ($this->plugin_dir . 'st-page/st-page-loader.php');
  }

  /**
   * Setup globals.
   *
   * @since 1.0
   * @access private
   */

  private function setup_globals () {
    // Paths
    $this->file             = __FILE__;
    $this->basename         = plugin_basename($this->file);
    $this->plugin_dir       = ST_PLUGIN_DIR;
    $this->plugin_url       = ST_PLUGIN_URL;

    $this->name             = __('Simple settings', 'simple_settings');
    $this->settings         = ' ' . __('Settings', 'simple_settings');
  }

  /**
   * Setup the default hooks and actions.
   *
   * @since 1.0
   * @access private
   */

  private function setup_actions () {
    add_action('activate_' . $this->basename, 'st_activation');
    add_action('deactivate_' . $this->basename, 'st_deactivation');
  }
}

/**
 * Returning the Simple Settings instance to everyone.
 *
 * @return Simple Settings instance
 */

function simple_settings () {
  return Simple_Settings::instance();
}

// Let's make it global too!
$GLOBALS['st'] = &simple_settings();

endif;