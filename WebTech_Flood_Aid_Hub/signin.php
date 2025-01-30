<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'config.php'; 

    $email = $_POST['email'];
    $password = $_POST['password'];


    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            if ($user['user_status'] === 'inactive') {
                $error = "Your account is inactive. Please contact support.";
            } else {

                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $user['id']; 
                $_SESSION['first_name'] = $user['first_name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['user_type'] = $user['user_type'];

                if ($user['user_type'] === 'admin') {
                    header("Location: admin_homepage.php");
                } else {
                    header("Location: homepage.php");
                }
                exit();
            }
        } else {
            $error = "Invalid password. Please try again.";
        }
    } else {
        $error = "No account found with that email address.";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="signin.css"> 
</head>
<body>

<div class="signin-container">
    <h2>Sign In</h2>
    <?php if (isset($error)): ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form action="signin.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>

        <button type="submit">Sign In</button>
        
        <div class="form-footer">
            <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
        </div>
    </form>
</div>

</body>
</html>