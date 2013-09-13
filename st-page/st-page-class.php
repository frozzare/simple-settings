<?php

/**
 * Theme settings
 *
 * @copyright Copyright 2013 Fredrik Forsmo (http://forsmo.me)
 * @license The MIT License
 */

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

if (!class_exists('ST_Page')):

class ST_Page {

  private $key = 'ST_Page';

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
    if (!defined('ST_PAGE_PATH')) {
      define('ST_PAGE_PATH', get_template_directory() . '/inc/st-pages/');
    }
    foreach (glob(ST_PAGE_PATH . '*') as $file) {
      require_once($file);
      $name = basename($file, '.php');
      $name = str_replace('-st-page', '', $name);
      $name = ucfirst($name);
      $name .= '_ST_Page';
      $name = str_replace('-', '_', $name);
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
    $slug = 'st-' . st_slug($this->options['name']);
    add_submenu_page('st-page', $this->options['name'], $this->options['name'], 'manage_options', $slug, array($this, 'page_callback'));
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
   * Update settings.
   *
   * @since 1.0
   */

  public function update_settings () {
    if (isset($_POST['action']) && $_POST['action'] === 'update') {
      $pattern = '/' . str_replace('_', '\_', starialize()) . '.*/';
      $keys = preg_grep($pattern, array_keys($_POST));
      foreach ($keys as $key) {
        st_update_option($key, $_POST[$key]);
      }
    }
  }

  /**
   * Page callback.
   *
   * @since 1.0
   */

  public function page_callback () {
    $this->update_settings();
    $name = $this->options['name'];
    $methods = $this->collect_methods($this);
    ?>
    <div class="wrap">
      <div id="icon-options-general" class="icon32"><br></div>
      <h2><?php echo __( $name . ' settings', 'simple_settings' ); ?></h2>
      <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" value="update" />
        <table class="form-table">
          <tbody>
            <?php
              foreach ($methods as $method):
                $options = $this->$method();
                $this->page_tr_row($options);
              endforeach;
            ?>
          </tbody>
        </table>
        <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>
      </form>
    </div>
    <?php
  }

  public function page_tr_row (array $options = array()) {
    ?>
    <tr valign="top">
      <th scope="row">
        <?php
          $args = array(
            'html' => $options['label']
          );
          if (isset($options['name'])) {
            $args['for'] = $options['name'];
          }
          $label = new ST_Label_Tag($args);
          $label->display();
        ?>
      </th>
      <td>
        <?php
          if (isset($options['input']) || isset($options['textarea']) || isset($options['select'])) {
            if (isset($options['input'])) {
              $field = new ST_Input_Tag (array(
                'name' => $options['name'],
                'value' => st_get_option($options['name']),
                'type' => $options['input']['type'],
              ));
            } else if (isset($options['textarea'])) {
              $field = new ST_Textarea_Tag (array(
                'name' => $options['name'],
                'html' => st_get_option($options['name'])
              ));
            } else if (isset($options['select'])) {
              $field = new ST_Select_Tag(array(
                'name' => $options['name'],
                'options' => $options['select']['options'],
                'selected' => st_get_option($options['name'], $options['select']['selected'])
              ));
            }
            $field->display();
          } else if (isset($options['inputs']) && is_array($options['inputs'])) {
            $output = '';
            foreach ($options['inputs'] as $input) {
              if (isset($input['label'])) {
                $args = array(
                  'html' => $input['label']
                );
                if (isset($options['name'])) {
                  $args['for'] = $options['name'];
                }
                $label = new ST_Label_Tag($args);
                $output .= $label->render();
              }
              $field = new ST_Input_Tag (array(
                'name' => $options['name'],
                'value' => st_get_option($options['name']),
                'type' => $input['type'],
                'class' => ''
              ));
              $output .= $field->render();
            }
            echo $output;
          } else {
            echo $options['html'];
          }
        ?>
      </td>
   </tr>
    <?php
  }

  /**
   * Setup actions.
   *
   * @since 1.0
   * @access private
   */

  private function setup_actions () {
    add_action('st_admin_menu', array($this, 'setup_page'));
  }

}

function st_page () {
  new ST_Page();
}

st_page();

endif;