<?php
/**
 * Läs in settings/konfiguration och returnera dem vid behov
 */
 
function get_setting($sname)
{
	static $settings;
	if ( !empty($settings) ) {
		if ( array_key_exists($sname, $settings) ) {
			return $settings[$sname];
		} else {
			return null;
		}
	}
	
	$settings['dsn'] = array(
		'phptype'	=> 'mysql',
		'hostspec'	=> 'localhost',
		'database'	=> 'te-12-adam'
		'username'	=> 'te-12-adam'
		'password'	=> '76c5e57f66'
		);
		$settings['dbtime'] = 'Europa/Stockholm';
		return $settings[$name];
}