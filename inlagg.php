<?php
 /*
  * Filen gör det möjligt att göra inlägg på sidan
  */
  
    session_start();
     
    require_once ("dbcx.php");
    $dbh = dbcx();
    
