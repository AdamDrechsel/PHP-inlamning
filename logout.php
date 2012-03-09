<?php
    session_start();
    unset($_SESSION);
    session_regenerate_id();
    session_destroy();
    HEADER("location: register.php");