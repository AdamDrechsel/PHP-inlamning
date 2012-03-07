<?php
    unset($_SESSION);
    session_destroy();
    HEADER("location: register.php");