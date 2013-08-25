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

  private $key = 'TS_Page';

  private $pages;

  public function __construct (array $options = array()) {
    $this->options = $options;
    $this->setup_globals();
    if (empty($options)) {
      $this->load_pages();
    }
    $this->setup_actions();
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
   * Setup globals.
   *
   * @since 1.0
   * @access private
   */

  private function setup_globals () {

  }

  /**
   * Load page.
   *
   * @since 1.0
   * @access private
   */

  private function load_pages () {
    if (!defined('TS_PAGE_PATH')) {
      define('TS_PAGE_PATH', get_template_directory() . '/inc/ts-pages/');
    }
    foreach (glob(TS_PAGE_PATH . '*') as $file) {
      require_once($file);
      $name = basename($file, '.php');
      $name = str_replace('-ts-page', '', $name);
      $name = ucfirst($name);
      $name .= '_TS_Page';
      if (!isset($this->pages[$name])) {
        $this->pages[$name] = new $name;
      }
    }
  }

  /**
   * Setup page.
   *
   * @since 1.0
   */

  public function setup_page () {
    if (empty($this->options)) return;
    $slug = 'ts-' . ts_slug($this->options['name']);
    add_submenu_page('ts-page', $this->options['name'], $this->options['name'], 'manage_options', $slug, array($this, 'page_callback'));
  }

  /**
   * Setup pages.
   *
   * @since 1.0
   * @access private
   */

  private function setup_pages () {
    /*$methods = $this->collect_methods($page);
    foreach ($methods as $method) {
      $options = $page->$method();
      if (is_array($options)) {
      }
    }*/
  }

  /**
   * Callback
   *
   * @since 1.0
   */

  public function page_callback () {
    $name = $this->options['name'];
    $methods = $this->collect_methods($this);
    ?>
    <div class="wrap">
      <div id="icon-options-general" class="icon32"><br></div>
      <h2><?= __( $name . ' settings', 'theme_settings' ); ?></h2>
      <table class="form-table">
        <tbody>
          <?php foreach ($methods as $method):
            $data = $this->$method();
            if (isset($data['label']) && isset($data['field']) && isset($data['name'])):
          ?>
          <tr valign="top">
            <th scope="row">
              <label for><?= $data['label']; ?></label>
            </th>
            <td>
              <?php
                $field = $this->get_field($data['field'], $data['name']);
                echo $field->render();
             ?>
            </td>
          </tr>
        <?php
            endif;
          endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php
  }

  /**
   * Get input field.
   *
   * @param string $type
   * @since 1.0
   *
   * @return object
   */

  public function get_field ($type, $name) {
    switch ($type) {
      case 'text':
        $field = new TS_Input_Text();
        $field->setAttribute('name', $name);
        return $field;
        break;
      default:
        return new stdClass();
    }
  }

  /**
   * Setup actions.
   *
   * @since 1.0
   * @access private
   */

  private function setup_actions () {
    if (empty($this->options)) return;
    add_action('ts_admin_menu', array($this, 'setup_page'));
  }

}

function ts_page () {
  new TS_Page();
}

ts_page();

endif;