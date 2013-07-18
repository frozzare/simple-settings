<?php

class Theme_Settings {

  /**
   * Instance of this class.
   *
   * @since 0.1
   *
   * @var object
   */

  private static $instance;

  /**
   * Get the instance of this class.
   *
   * @since 0.1
   *
   * @return Object A single instance of this class.
   */

  public static function instance () {
    if (!isset(self::$instance)) {
      self::$instance = new self;
      self::$instance->constants();
      self::$instance->setup_globals();
      self::$instance->includes();
      self::$instnace->setup_actions();
    }
    return self::$instance;
  }

  /**
   * Construct. Nothing to see.
   *
   * @since 0.1
   *
   * @return void
   */

  private function __construct () {}

  /**
   * Bootstrap constants
   *
   * @since 1.0
   *
   * @return void
   */

  private function constants () {
  }

  /**
   * Include files.
   *
   * @since 1.0
   *
   * @return void
   */

  private function includes () {
  }

  /**
   * Setup globals.
   *
   * @since 1.0
   *
   * @return void
   */

  private function setup_globals () {
  }

  /**
   * Setup the default hooks and actions.
   *
   * @since 1.0
   *
   * @return void
   */

  private function setup_actions () {
    add_action('activate_' . $this->basename, 'class_activation');
    add_action('deactivate_' . $this->basename, 'class_deactivation');
  }
}