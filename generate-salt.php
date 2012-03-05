<?php

/**
* This function generates a password salt as a string of x (default = 15) characters
* ranging from a-zA-Z0-9.
* @param $max integer The number of characters in the string
* @author AfroSoft <info@afrosoft.tk>
*/
function generateSalt($max = 16) {
$characterList = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
$i = 0;
$salt = "";
do {
$salt .= $characterList{mt_rand(0,strlen($characterList)-1)};
$i++;
} while ($i < $max);
return $salt;
}

?>