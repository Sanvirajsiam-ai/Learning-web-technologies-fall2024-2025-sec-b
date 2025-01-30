<?php
include('config.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);

    if (!preg_match("/^[a-zA-Z ]*$/", $first_name)) {
        $error = "First name should only contain letters and spaces.";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $last_name)) {
        $error = "Last name should only contain letters and spaces.";
    }

    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    }

    elseif ($password !== $confirmPassword) {
        $error = "Passwords do not match.";
    }

    else {
        $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $checkEmailQuery);

        if (mysqli_num_rows($result) > 0) {

            $error = "This email is already registered. Please use a different email.";
        } else {

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$hashedPassword')";

            if (mysqli_query($conn, $sql)) {
                header("Location: signin.php"); 
                exit();
            } else {
                $error = "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="signup.css"> 
</head>
<body>

<div class="signup-container">
    <h2>Sign Up</h2>

    <?php if (isset($error)): ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form action="signup.php" method="POST">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" placeholder="Enter your first name" required pattern="[A-Za-z ]+" title="First name should only contain letters and spaces.">

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" placeholder="Enter your last name" required pattern="[A-Za-z ]+" title="Last name should only contain letters and spaces.">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>

        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password" required>

        <button type="submit">Sign Up</button>

        <div class="form-footer">
            <p>Already have an account? <a href="signin.php">Sign In</a></p>
        </div>
    </form>
</div>

</body>
</html>
