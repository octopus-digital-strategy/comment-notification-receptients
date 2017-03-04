<?php
/**
 * Plugin name: Comment Notification Receptients
 * Plugin URI: https://github.com/octopus-digital-strategy/comment-notification-receptients
 * Description: This plugin lets you add more emails that will receive the comments notification for this site.
 * Version: 0.1
 * Author: jcastro91
 * Author URI: https://jorgecastro.mx
 */

// No direct access to this file
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Composer implementation
require_once('vendor/autoload.php');

// Instance the Setup
new \CommentNot\SetupPlugin();