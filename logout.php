<?php
session_start();

// Check if the user is logged in
if(isset($_SESSION['user_id'])) {
    // Unset all of the session variables
    $_SESSION = array();

    // Delete the session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Destroy the session
    session_destroy();
}

// Redirect the user to the login page or wherever you want after logout
header("Location: main_login.php");
exit;
?>
