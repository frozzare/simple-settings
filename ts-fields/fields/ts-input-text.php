<?php

/**
 * Theme settings
 *
 * @copyright Copyright 2013 Fredrik Forsmo (http://forsmo.me)
 * @license The MIT License
 */

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

if (!class_exists('TS_Input_Text')):

class TS_Input_Text extends TS_Input_Field {

  /**
   * Field type
   *
   * @var string
   */

  public function __construct () {
    parent::__construct();
    $this->setAttribute('type', 'text');
    $this->setTag('<input', '/>');
  }
}

endif;