<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize inputs
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $name = htmlspecialchars(trim($_POST['name']));
    $user_type = $_POST['user_type'];

    // Initialize error array
    $errors = [];

    // Validation checks
    if (empty($id) || !is_numeric($id)) {
        $errors[] = "Invalid ID. Please provide a numeric value.";
    }

    if (empty($password) || strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    if (empty($name)) {
        $errors[] = "Name cannot be empty.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        $errors[] = "Name must contain only letters and spaces.";
    }

    if (empty($user_type) || !in_array($user_type, ["user", "admin"])) {
        $errors[] = "Please select a valid user type.";
    }

    // Check for errors
    if (empty($errors)) {
        // Success: Save user data (mock database save example)
        // In real-world scenarios, hash the password before saving
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Save to database logic goes here

        echo "Registration successful!";
        header("Location: login.html"); // Redirect to login page
        exit();
    } else {
        // Show errors
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}
?>
