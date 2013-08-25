<?php

/**
 * Theme settings
 *
 * @copyright Copyright 2013 Fredrik Forsmo (http://forsmo.me)
 * @license The MIT License
 */

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

if (!class_exists('TS_Page_Admin')):

class TS_Page_Admin {

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
     $ts = theme_settings();

     // Paths and URLs
     $this->admin_dir  = trailingslashit($ts->plugin_dir  . 'ts-core/admin' );
     $this->admin_url  = trailingslashit($ts->plugin_url  . 'ts-core/admin' ); // Admin url
     $this->images_url = trailingslashit($this->admin_url . 'images'        ); // Admin images URL
     $this->css_url    = trailingslashit($this->admin_url . 'css'           ); // Admin css URL
     $this->js_url     = trailingslashit($this->admin_url . 'js'            ); // Admin css URL
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

    private function setup_actions () {
      // Add menu item to the menu
      add_action('ts_admin_menu', array($this, 'admin_menus'), 5);
    }

    /**
     * Add admin menus.
     *
     * @since 1.0
     */

    public function admin_menus () {
      // Exit if user can't manage options
      if (!current_user_can('manage_options')) return;
    }
}

function ts_page_admin () {
  new TS_Page_Admin();
}

endif;