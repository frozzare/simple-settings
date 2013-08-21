<?php

/**
 * Theme settings
 *
 * @copyright Copyright 2013 Fredrik Forsmo (http://forsmo.me)
 * @license The MIT License
 */

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

if (!class_exists('TS_Admin')):

class TS_Admin {

  /**
   * Path to the admin directory
   */

  public function __construct () {
    $this->setup_globals();
    $this->includes();
    $this->setup_actions();
  }

  /**
   * Setup admin globals
   *
   * @since 1.0
   * @access private
   */

   private function setup_globals () {

   }

   /**
    * Includes required admin files.
    *
    * @since 1.0
    * @access private
    */

    private function includes () {

    }

    /**
     * Setup admin actions.
     *
     * @since 1.0
     * @access private
     */

     public function setup_actions () {
       // Add output to <head> tag
       //add_action('ts_admin_head', array($this, 'admin_head'), 999);

       // Add menu item to the menu
       add_action('admin_menu', array($this, 'admin_menus'), 5);

       // Enqueue all admin assets
       //add_action('ts_admin_enqueue_scripts', array($this, 'enqueue_scripts'));
    }

    /**
     * Add admin menus
     *
     * @since 1.0
     */

    public function admin_menus () {
      // Exit if user can't manage options
      if (!current_user_can('manage_options')) return;

      add_menu_page(
        __('Theme settings', 'theme_settings'),
        __('Theme settings', 'theme_settings'),
        'manage_options', // manage_options
        'ts-page',
        array($this, 'ts_page')
      );
    }

    /**
     * Theme settings main page.
     *
     * @since 1.0
     */

    public function ts_page () {
      include 'admin/views/main-page.php';
    }

}

function ts_admin () {
  new TS_Admin();
}

endif;