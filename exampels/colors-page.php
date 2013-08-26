<?php

class Colors_ST_Page extends ST_Page {

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
      'html' => '<h1>Color settings</h1>'
    );
  }

}