<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    if (empty($email)) {
        echo "Error: Email cannot be empty.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Error: Invalid email format.";
    } else {
        echo "Email: " . htmlspecialchars($email);
    }
}
?>