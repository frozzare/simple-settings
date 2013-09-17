<?php

/**
 * Simple settings
 *
 * @copyright Copyright 2013 Fredrik Forsmo (http://forsmo.me)
 * @license The MIT License
 */

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

if (!class_exists('ST_Page_Admin')):

class ST_Page_Admin {

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
     $st = simple_settings();

     // Paths and URLs
     $this->admin_dir  = trailingslashit($st->plugin_dir  . 'st-core/admin' );
     $this->admin_url  = trailingslashit($st->plugin_url  . 'st-core/admin' ); // Admin url
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
      add_action('st_admin_menu', array($this, 'admin_menus'), 5);
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

/**
 * Returning new instance of Simple Settings page admin class.
 *
 * @return object
 */

function st_page_admin () {
  new SS_Page_Admin();
}

endif;