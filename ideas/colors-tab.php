<?php

class Colors extends TS_Tab {

  /**
   * Set options for this tab
   */

  public function __construct () {
    parent::__construct(array(
      'name' => 'Color'
    ));
  }

  /**
   * Add background color field to the settings page.
   */

  public function background () {
    return array(
      'title' => 'Site background color',
      'field' => 'text',
      'value' => '',
      'default' => '#000000'
    );
  }

  /**
   * Add heading tag to the settings page.
   */

  public function heading () {
    return array(
      'text' => 'Color settings',
      'html' => '<h1>%s</h1>'
    );
  }

}