<?php

/**
 * @package RealGoogleLogin
 * @version 1.7
 */
/*
Plugin Name: Real Google Login
Description: The only working google login plugin for Wordpress
Author: oliver.eisenhut@gmail.com
Version: 0.1
 */
defined('ABSPATH') or die('No script kiddies please!');
require_once 'vendor/autoload.php';

function custom_rewrite_rule()
{
  add_action('template_redirect', 'handle_auth');
  add_filter('v_forcelogin_bypass', 'whitelist_login');
}

function whitelist_login($urls)
{
  $code = $_GET['code'];
  if ($code) {
    require('google_client.php');
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    return $token['error'] == null;
  }
  return false;
}

function handle_auth()
{
  $code = $_GET['code'];
  if ($code) {
    require('handle_auth.php');
  }
}

function myplugin_add_login_fields()
{
  require('google_client.php')
  ?>
  <div class="request">
    <a class='login' href='<?= $authUrl ?>'>Connect Me!</a>
  </div>
  <?php

}

add_action('login_form', 'myplugin_add_login_fields');
add_action('init', 'custom_rewrite_rule', 10, 0);
