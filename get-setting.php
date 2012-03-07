<?php
function get_setting($name) {
    static $settings;
    if (!empty($settings)) {
        if (array_key_exists($name, $settings)) {
            return $settings[$name];
        } else {
            return null;
        }
    }
    $settings['dsn'] = array(
        'phptype' => 'mysql',
        'hostspec' => 'localhost',
        'database' => 'te-12-adam',
        'username' => 'te-12-adam',
        'password' => '76c5e57f66'
    );
    $settings['dbtime'] = "Europe/Stockholm";
    return $settings[$name];
}