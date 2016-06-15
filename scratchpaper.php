<?php
function bakery_user_menu() {
    $items['welcome'] = array(
        'title' => 'Hi there!',
        'page callback' => 'welcome_user',
        'access callback' => TRUE,
        'type' => MENU_CALLBACK,
    );
    return $items;
}

function bakery_user_login(&$edit, $account) {
    $_GET['destination'] = 'welcome_';
}

function welcome_user() {
    return "<p>Welcome to Cameron's Bakery!</p>";
}
