<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize inputs
    $user_id = trim($_POST['user_id']);
    $password = trim($_POST['password']);

    // Initialize error array
    $errors = [];

    // Validate inputs
    if (empty($user_id)) {
        $errors[] = "User ID cannot be empty.";
    }

    if (empty($password)) {
        $errors[] = "Password cannot be empty.";
    }

    // Mock user data for validation
    // In real-world applications, fetch this from a database
    $mock_user_data = [
        "id" => "12345",
        "password" => '$2y$10$eZFXQ3vPbC.bmb/VPAGUye7OB3kVjVxDpEMp7igPP5rS8B/1kuzTO', // "password123" hashed
    ];

    if (empty($errors)) {
        // Check credentials
        if ($user_id == $mock_user_data["id"] && password_verify($password, $mock_user_data["password"])) {
            echo "Login successful!";
            header("Location: home.html"); // Redirect to home page
            exit();
        } else {
            echo "<p style='color:red;'>Invalid User ID or Password.</p>";
        }
    } else {
        // Show errors
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}
?>
