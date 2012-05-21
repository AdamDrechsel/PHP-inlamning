<?php
    /*
    *En simpel funktion som gör det möjligt att logga ut från sidan
    *
    * @author Adam Drechsel
    */
    session_start();
    unset($_SESSION);
    session_regenerate_id();
    session_destroy();
    HEADER("location: register.php");