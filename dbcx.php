<?php
/**
 * Filen innehåller funktionen dbcx (database connection), samt hjälpfunktioner för databasuppkoppling.
 *
 * @author		Adam Drechsel & Lars Gunther
 * @copyright 	Adam Drechsel & Lars Gunther
 */
 
 if ( get_magic_quotes_runtime() ) {
 throw new Exception('Magic quotes runtime är på. Applikationens databasfunktioner kräver att de är av.');
 }
 
 require_once "get-setting.php";
 
 function dbcx() {
	$E_UNSUP_DRIVER = 'Stöd saknas ännu i applikationen för denna driver : %s';
	static $db;
	
	if (!is_null($db) ) {
		return $db;
	}
	$dsn = get_setting("dsn");
	$dsnstr	= "{$dsn['phptype']}:host={$dsn['hostspec']};dbname={$dsn['database']}";
	$dbuser	= $dsn['username'];
	$dbpass	= $dsn['password'];
	try{
		$db = new PDO($dsnstr, $dbuser, $dbpass);
		if (empty($db) ) {
			throw new Exception("PDO kunde inte instansieras, uppkopplingen misslyckad.");
		}
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		if ( $db->getAttribute(PDO::ATTR_DRIVER_NAME) != 'mysql' ) {
			throw new Exception(sprintf($E_UNSUP_DRIVER,
			$db->getAttribute(PDO::ATTR_DRIVER_NAME)));
		}
		
		$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		
		$charset_sql = "SET NAMES 'UTF8' COLLATE 'utf8_swedish_ci'";
		$db->query($charset_sql);
		
		$dbtime	= get_setting('dbtime');
		$ts_sql	= "SET time_zone = '$dbtime'";
		$svar	= $db->query($ts_sql);
		
		$mode_sql	= "SET SESSION sql_mode = 'STRICT_ALL_TABLES,NO_ZERO_DATE,NO_ZERO_IN_DATE'";
		$svar		= $db->query($mode_sql);
	}
	catch (Exception $e) {
		echo "<pre>";
		var_dump($e);
		echo "<hr />";
		var_dump($db);
		echo "<hr />";
		var_dump($dsn);
		echo "<hr />";
		exit;
	}
	return $db;
 }