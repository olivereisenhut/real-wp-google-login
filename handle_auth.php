<?php
defined('ABSPATH') or die('No script kiddies please!');
require('google_client.php');

try {

    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $person = $service->people->get('me');
    $display_name = $person->displayName;
    $email = array_pop($person->getEmails())->value;

    $user_name = str_replace("", "_", $display_name);
    if (!username_exists($user_name)) {
        $password = uniqid();
        wp_create_user($display_name, $password, $email);
    }
    $user = get_user_by('email', $email);
    // TODO sane validation
    $user->remove_role('subscriber');
    $user->add_role('editor');

    wp_set_current_user($user->ID, $user_name);
    wp_set_auth_cookie($user->ID, true);

    do_action('wp_login', $user_name, $user);

    wp_safe_redirect(site_url());
} catch (Exception $e) {
    return;
}

?>