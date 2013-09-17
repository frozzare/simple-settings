<?php

class Social_ST_Page extends ST_Page {

  /**
   * Set options for this tab
   */

  public function __construct () {
    parent::__construct(array(
      'name' => 'Social media',
      'settings' => ' settings'
    ));
  }

  /**
   * Add Facebook url field to the settings page.
   */

  public function facebook () {
    return array(
      'label' => 'Facebook',
      'fields' => array(
        array(
          'type' => 'url',
          'field' => 'input',
          'text_before' => 'Url',
          'name' => 'facebook_url'
        ),
        array(
          'type' => 'checkbox',
          'field' => 'input',
          'text_before' => 'Show like button',
          'name' => 'facebook_hidden'
        )
      )
    );
  }

  /**
   * Add Twitter url field to the settings page.
   */

  public function twitter () {
    return array(
      'label' => 'Twitter',
      'fields' => array(
        array(
          'type' => 'url',
          'field' => 'input',
          'text_before' => 'Url',
          'name' => 'twitter_url'
        ),
        array(
          'type' => 'checkbox',
          'field' => 'input',
          'text_before' => 'Show Tweet button',
          'name' => 'twitter_hidden'
        )
      )
    );
  }

  /**
   * Add Google+ url field to the settings page.
   */

  public function googlep_url () {
    return array(
      'label' => 'Google+ url',
      'fields' => array(
        array(
          'type' => 'url',
          'field' => 'input',
          'text_before' => 'Url',
          'name' => 'googlep_url'
        ),
        array(
          'type' => 'checkbox',
          'field' => 'input',
          'text_before' => 'Show Google+ button',
          'name' => 'googlep_hidden'
        )
      )
    );
  }

}