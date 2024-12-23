<?php
// Start the session
session_start();

// Check if matricule is provided
if (isset($_POST['matricule'])) {
    $matricule = $_POST['matricule'];

    // Retrieve existing favorites from the cookie or initialize an empty array
    $favorites = isset($_COOKIE['favorites']) ? json_decode($_COOKIE['favorites'], true) : [];

    // Remove the matricule if it exists in the list
    if (($key = array_search($matricule, $favorites)) !== false) {
        unset($favorites[$key]);

        // Save the updated favorites back to the cookie
        setcookie('favorites', json_encode(array_values($favorites)), time() + (86400 * 30), "/"); // 30 days
      
    } 
}

// Redirect back to the favorites page
header('Location: favorites.php');
exit;
?>
