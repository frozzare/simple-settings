<?php

/**
 * Add a general theme settings page.
 */

class General_ST_Page extends ST_Page {

  /**
   * Set options for the settings page.
   */

  public function __construct () {
    parent::__construct(array(
      'name' => 'General'
    ));
  }

  /**
   * Add contact email field to the settings page.
   *
   * @usage: st_get_option('contact_email');
   *
   */

  public function contact_email () {
    return array(
      'label' => 'Site contact email',
      'name' => 'contact_email',
      'input' => array(
        'type' => 'text',
        'value' => ''
      )
    );
  }

  public function copyright_text () {
    return array(
      'label' => 'Copyright text',
      'name' => 'copyright_text',
      'textarea' => array()
    );
  }

  public function site_status () {
    return array(
      'label' => 'Site status',
      'name' => 'site_status',
      'select' => array(
        'selected' => 'open',
        'options' => array(
          array(
            'value' => 'open',
            'html' => 'Open',
          ),
          array(
            'value' => 'closed',
            'html' => 'Closed'
          )
        )
      )
    );
  }

  public function just_html () {
    return array(
      'html' => '<h1>Hello, world! xae a eag a a a ag a</h1>',
    );
  }
}