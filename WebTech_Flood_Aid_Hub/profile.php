<?php
session_start();
include('config.php'); 

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $firstName = $_SESSION['first_name'];
    $lastName = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $userId = $_SESSION['user_id'];
} else {
    header("Location: signin.php");
    exit();
}

$campaignsQuery = "SELECT campaigns.title, campaigns.goal, campaigns.funds_raised, user_campaigns.amount_funded 
                   FROM user_campaigns 
                   JOIN campaigns ON user_campaigns.campaign_id = campaigns.id 
                   WHERE user_campaigns.user_id = ?";
$stmt = $conn->prepare($campaignsQuery);
$stmt->bind_param("i", $userId);
$stmt->execute();
$campaignsResult = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - RaiseSeed</title>
    <link rel="stylesheet" href="profile.css"> 
</head>
<body>
    <div class="profile-container">
        <h2>Profile Information</h2>
        <p><strong>First Name:</strong> <?php echo htmlspecialchars($firstName); ?></p>
        <p><strong>Last Name:</strong> <?php echo htmlspecialchars($lastName); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>

        <h2>Funded Campaigns</h2>
        <table class="campaigns-table">
            <thead>
                <tr>
                    <th>Campaign Title</th>
                    <th>Goal Amount</th>
                    <th>Funds Raised</th>
                    <th>Your Contribution</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($campaignsResult->num_rows > 0): ?>
                    <?php while ($campaign = $campaignsResult->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($campaign['title']); ?></td>
                            <td><?php echo htmlspecialchars($campaign['goal']); ?></td>
                            <td><?php echo htmlspecialchars($campaign['funds_raised']); ?></td>
                            <td><?php echo htmlspecialchars($campaign['amount_funded']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">You have not funded any campaigns yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
