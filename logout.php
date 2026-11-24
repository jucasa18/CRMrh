<?php
include('auth_session.php');
include('session_expire.php');
    // Destroy session
    if(session_destroy()) {
        // Redirecting To Home Page
        header("Location: index.php");
    }
?>