<?php

/**
 * Theme settings
 *
 * @copyright Copyright 2013 Fredrik Forsmo (http://forsmo.me)
 * @license The MIT License
 */

/**
 * Plugin Name: WordPress Theme Settings
 * Description: Settings page for your theme
 * Author: Fredrik Forsmo
 * Author URI: http://forsmo.me/
 * Version: 1.0
 * Plugin URI: https://github.com/frozzare/theme-settings
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

// Check so class don't exists before we creat it.
if (!class_exists('Theme_Settings')):

/**
 * Theme Settings class.
 *
 * Tap tap tap... Is this thing on?
 *
 * @since 1.0
 */

class Theme_Settings {

  /**
   * The instance of Theme Settings
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
   * @return The instance of Theme Settings
   */

  public static function instance () {
    if (!isset(self::$instance)) {
      self::$instance = new Theme_Settings;
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
    // Path to Theme settings plugin directory
    if (!defined('TS_PLUGIN_DIR')) {
      define('TS_PLUGIN_DIR', trailingslashit(WP_PLUGIN_DIR . '/theme-settings'));
    }

    // URL to Theme settings plugin directory
    if (!defined('TS_PLUGIN_URL')) {
      $plugin_url = plugin_dir_url(__FILE__);

      if (is_ssl()) {
        $plugin_url = str_replace('http://', 'https://', $plugin_url);
      }

      define('TS_PLUGIN_URL', $plugin_url);
    }
  }

  /**
   * Include files.
   *
   * @since 1.0
   * @access private
   */

  private function includes () {
    require ($this->plugin_dir . 'ts-core/ts-functions.php');
    require ($this->plugin_dir . 'ts-core/ts-admin.php');
    require ($this->plugin_dir . 'ts-core/ts-actions.php');
    require ($this->plugin_dir . 'ts-fields/ts-fields-loader.php');
    require ($this->plugin_dir . 'ts-page/ts-page-loader.php');
  }

  /**
   * Setup globals.
   *
   * @since 1.0
   * @access private
   */

  private function setup_globals () {
    $this->version          = '1.0.0';
    $this->db_version       = 100;
    $this->db_version_raw   = 0;

    $this->table_prefix     = 'ts_';

    // Paths
    $this->file             = __FILE__;
    $this->basename         = plugin_basename($this->file);
    $this->plugin_dir       = TS_PLUGIN_DIR;
    $this->plugin_url       = TS_PLUGIN_URL;
  }

  /**
   * Setup the default hooks and actions.
   *
   * @since 1.0
   * @access private
   */

  private function setup_actions () {
    add_action('activate_' . $this->basename, 'ts_activation');
    add_action('deactivate_' . $this->basename, 'ts_deactivation');
  }
}

/**
 * Returning the Theme Settings instance to everyone.
 *
 * @return Theme Settings instance
 */

function theme_settings () {
  return Theme_Settings::instance();
}

// Let's make it global too!
$GLOBALS['ts'] = &theme_settings();

endif;