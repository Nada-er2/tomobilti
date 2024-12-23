<?php
// Start the session
session_start();

// Check if matricule is provided
if (isset($_POST['matricule'])) {
    $matricule = $_POST['matricule'];

    // Retrieve existing favorites from the cookie or initialize an empty array
    $favorites = isset($_COOKIE['favorites']) ? json_decode($_COOKIE['favorites'], true) : [];

    // Add matricule to favorites if not already present
    if (!in_array($matricule, $favorites)) {
        $favorites[] = $matricule;

        // Save updated favorites in the cookie
        setcookie('favorites', json_encode($favorites), time() + (86400 * 30), "/"); // 30 days
        
    } else {
        
    }
}

// Redirect back to the previous page
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
?>
