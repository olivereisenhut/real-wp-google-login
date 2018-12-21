<?php
defined('ABSPATH') or die('No script kiddies please!');
// TODO load this from somewhere else
$config_file_path = plugin_dir_path(__FILE__) . 'client_secret.json';

$client = new Google_Client();
$client->setAuthConfig($config_file_path);
$client->addScope(Google_Service_Plus::USERINFO_PROFILE);
$client->addScope(Google_Service_Plus::USERINFO_EMAIL);
$redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . "/";
$client->setRedirectUri($redirect_uri);
//$client->setClientId('dsjfsl');
//$client->setClientId('dkfsd');

$authUrl = $client->createAuthUrl();
$service = new Google_Service_Plus($client);