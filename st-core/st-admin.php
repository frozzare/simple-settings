<?php

/**
 * Simple settings
 *
 * @copyright Copyright 2013 Fredrik Forsmo (http://forsmo.me)
 * @license The MIT License
 */

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

if (!class_exists('ST_Admin')):

class ST_Admin {

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
      require($this->admin_dir . 'st-actions.php');
    }

    /**
     * Setup admin actions.
     *
     * @since 1.0
     * @access private
     */

     private function setup_actions () {
       // Add output to <head> tag
       // add_action('st_admin_head', array($this, 'admin_head'), 999);

       // Add menu item to the menu
       add_action('st_admin_menu', array($this, 'admin_menus'), 5);

       // Enqueue all admin assets
       add_action('st_admin_enqueue_scripts', array($this, 'enqueue_scripts'));
    }

    /**
     * Add admin menus
     *
     * @since 1.0
     */

    public function admin_menus () {
      // Exit if user can't manage options
      if (!current_user_can('manage_options')) return;

      $st = simple_settings();

      add_menu_page(
        $st->name,
        $st->name,
        'manage_options',
        'st-page',
        array($this, 'st_page'),
        '',
        82
      );
    }

    /**
     * Empty page callback.
     *
     * @since 1.0
     */

    public function st_page () {}

    /**
     * Enqueue scripts and css.
     *
     * @since 1.0
     */

    public function enqueue_scripts () {
      wp_enqueue_style('st-admin-css', $this->css_url . 'admin.css', array(), '1.0.0');
      wp_enqueue_script('jquery');
      wp_enqueue_script('st-admin-js', $this->js_url . 'admin.js', array('jquery'), '1.0.0', true);
    }

}

/**
 * Returning new instance of Simple Settings admin class.
 *
 * @return object
 */

function st_admin () {
  new ST_Admin();
}

endif;