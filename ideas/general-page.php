<?php

class General extends TS_Page {

  /**
   * Set options for this tab
   */

  public function __construct () {
    parent::__construct(array(
      'name' => 'General'
    ));
  }

  /**
   * Add background color field to the settings page.
   */

  public function contact_email () {
    return array(
      'title' => 'Site contact email',
      'field' => 'text',
      'value' => '',
      'default' => ''
    );
  }

  /**
   * Add heading tag to the settings page.
   *

  public function heading () {
    return array(
      'text' => 'General settings',
      'html' => '<h1>%s</h1>'
    );
  }
  */
}