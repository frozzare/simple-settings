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

  /**
   * Class key.
   *
   * @var string
   */

  private $key = 'ST_Page';

  /**
   * Array with all loaded pages.
   *
   * @var array
   */

  private $pages;

  /**
   * Constructor.
   *
   * @param array $options
   * @since 1.0
   */

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
    if (!defined('ST_PAGES_PATH')) {
      define('ST_PAGES_PATH', get_template_directory() . '/inc/st-pages/');
    }
    foreach (glob(ST_PAGES_PATH . '*') as $file) {
      require_once($file);
      $name = basename($file, '.php');
      $name = str_replace('-st-page', '', $name);
      $name = ucfirst($name);
      $name .= '_' . $this->key;
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
        <?php if (isset($this->options['html']) || isset($this->options['text'])) {
          if (isset($this->options['text'])) {
            echo '<p>' . $this->options['text'] . '</p>';
          } else {
            echo $this->options['html'];
          }
        } ?>
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
              $field = $this->input($options, $options['input']);
            } else if (isset($options['textarea'])) {
              $field = $this->textarea($options, $options['textarea']);
            } else if (isset($options['select'])) {
              $field = $this->select($options, $options['select']);
            }

            $output = '';

            if (isset($options['html_before'])) {
              $output .= $options['html_before'];
            }

            $output .= $field->render();

            if (isset($options['html_after'])) {
              $output .= $options['html_after'];
            }

            echo $output;
          } else if (isset($options['fields']) && is_array($options['fields'])) {
            $output = '';
            $fieldset_wrap = false;
            foreach ($options['fields'] as $key => $value) {
              $label = null;
              $label_position = '';
              $html_after = '';

              if (!$fieldset_wrap) {
                $fieldset_wrap = $value['fieldset'] == true || $value['type'] == 'radio' || $value['type'] == 'checkbox';
              }

              if (isset($value['label'])) {
                if (is_array($value['label'])) {
                  $label = $this->label($options, array('label' => $value['label']['text']));
                  $label_position = $value['label']['position'];
                } else {
                  $label = $this->label($options, array('label' => $value['label']));
                  $label_position = isset($value['label_position']) ? $value['label_position'] : 'after';
                }
                unset($value['label']);
              }

              if (isset($value['html_before'])) {
                $output .= $value['html_before'];
                unset($value['html_before']);
              }

              if (isset($value['html_after'])) {
                $html_after = $value['html_after'];
                unset($value['html_after']);
              }

              $field = $this->field($value['field'], $options, $value);

              if (!is_null($field)) {

                if ($label_position == 'before') {
                  $output .= $label->render();
                } else if (strlen($label_position) > 0) {
                  $output .= $field->render();
                }

                if ($label_position == 'after') {
                  $output .= $label->render();
                } else if (strlen($label_position) > 0) {
                  $output .= $field->render();
                }

                if (strlen($label_position) == 0) {
                  $output .= $field->render();
                }

                if (!is_null($html_after) && strlen($html_after) > 0) {
                  $output .= $html_after;
                }
              }
            }

            if ($fieldset_wrap) {
              $output = str_replace('</label>', '</label><br/>', $output);
              $fieldset = new ST_Fieldset_Tag($output);
              $fieldset->display();
            } else {
              echo $output;
            }
          } else {
            echo $options['html'];
          }
        ?>
      </td>
   </tr>
    <?php
  }

  /**
   * Get field by type.
   *
   * @param string $type
   * @param array $options
   * @param array $args
   *
   * @since 1.0
   * @access private
   *
   * @return object|null
   */

  private function field ($type = '', array $options = array(), array $args = array()) {
    switch ($type) {
      case 'input':
        return $this->input($options, $args);
      case 'textarea':
        return $this->textarea($options, $args);
      case 'label':
        return $this->label($options, $args);
      case 'select':
        return $this->label($options, $args);
      default:
        break;
    }
  }

  /**
   * Create input tag.
   *
   * @param array $options
   * @param array $args
   *
   * @since 1.0
   * @access private
   *
   * @return object
   */

  private function input (array $options = array(), array $args = array()) {
    $name = isset($args['name']) ? $args['name'] : $options['name'];
    $value = st_get_option($name);
    $value = strlen($value) ? $value : isset($args['value']) ? $args['value'] : '';
    $field = new ST_Input_Tag (array(
      'name' => $name,
      'value' => $value
    ));
    if (isset($args['value'])) unset($args['value']);
    if (isset($args['type']) && ($args['type'] == 'radio' || $args['type'] == 'checkbox')) {
      $label = $this->label($options);
      $text = isset($args['text']) ? $args['text'] : '';
      if (isset($args['text'])) unset($args['text']);
      $field->setAttributes($args);
      $html = $field->render();
      $span = new ST_Span_Tag($text);
      $html .= $span->render();
      $label->setHtml($html);
      return $label;
    } else {
      $field->setAttributes($args);
      return $field;
    }
  }

  /**
   * Create label tag.
   *
   * @param array $options
   * @param array $args
   *
   * @since 1.0
   * @access private
   *
   * @return object
   */

  private function label (array $options = array(), array $args = array()) {
    $html = isset($args['label']) ? $args['label'] : $options['label'];
    $for = isset($options['name']) ? $options['name'] : '';
    return new ST_Label_Tag(array(
     'for' => $for,
     'html' => $html
    ));
  }

  /**
   * Create textarea tag.
   *
   * @param array $options
   * @param array $args
   *
   * @since 1.0
   * @access private
   *
   * @return object
   */

  private function textarea (array $options = array(), array $args = array()) {
    $html = isset($args['html']) ? $args['html'] : st_get_option($options['name']);
    return new ST_Textarea_Tag (array(
      'name' => $options['name'],
      'html' => $html
    ));
  }

  /**
   * Create select tag.
   *
   * @param array $options
   * @param array $args
   *
   * @since 1.0
   * @access private
   *
   * @return object
   */

  private function select (array $options = array(), array $args = array()) {
    return new ST_Select_Tag(array(
      'name' => $options['name'],
      'options' => $options['select']['options'],
      'selected' => st_get_option($options['name'], $options['select']['selected'])
    ));
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