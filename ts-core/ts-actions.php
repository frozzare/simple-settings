<?php

/**
 * This file contains actions and filters that are used through-out Theme settings.
 */

// @todo make more internal actions like in campsite

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

add_action('plugins_loaded', 'ts_fields', 10);
add_action('plugins_loaded', 'ts_admin', 11);