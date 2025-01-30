<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FloodAidHub</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">

    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div class="header-hero-section">
        <div class="header">
            <h1>Flood-Aid-Hub</h1>
            <div class="header-buttons">
                <a href="signin.php">Sign In</a>
                <a href="signup.php">Sign Up</a>
            </div>
        </div>

        <div class="hero-content">
            <h1>Flood-Aid-Hub: Helping Hands for a Brighter Tomorrow</h1>
            <p>Join us in providing essential relief and support to those affected by devastating floods</p>
            <button class="w3-button w3-black w3-large"><a href="signin.php">Support Now</a></button>
        </div>
    </div>

    <div class="w3-container w3-padding-64">
        <h2 class="w3-center"><a href="champ.php">Ongoing Relief Campaigns</a></h2>
        <div class="campaign-grid">
            <p>Loading campaigns...</p> 
        </div>
    </div>

    <div class="join-section">
        <div>
            <h2>Why Join Us?</h2>
            <p>FloodAidHub is the ideal platform for individuals passionate about providing support during flood crises.
                Join us to connect with others dedicated to offering aid and rebuilding affected communities.</p>
            <p>By joining, you'll become part of a compassionate community, gain access to expert resources, and help
                facilitate critical flood relief initiatives.</p>
        </div>
        <div>
            <h2>Why Support Us?</h2>
            <p>Supporting FloodAidHub means contributing to essential relief projects, including emergency supplies,
                shelter, and rebuilding efforts for flood-affected areas.</p>
            <p>Help us make a tangible difference—be a beacon of hope for communities in distress!</p>
        </div>
    </div>

    <div class="w3-container w3-padding-64">
        <h2 class="w3-center">How To Join FloodAidHub?</h2>
        <div class="how-to-join">
            <div class="how-step">
                <h3>Step 1: Create an Account</h3>
                <p>Sign up to become a member of FloodAidHub and gain access to impactful opportunities to support or
                    launch flood relief campaigns.</p>
            </div>
            <div class="how-step">
                <h3>Step 2: Explore Campaigns</h3>
                <p>Browse through various flood relief efforts, including emergency aid, housing reconstruction, and
                    community support initiatives.</p>
            </div>
            <div class="how-step">
                <h3>Step 3: Contribute or Launch</h3>
                <p>Whether you're supporting an existing campaign or starting your own, FloodAidHub makes it easy to
                    provide vital assistance to those in need.</p>
            </div>
        </div>
    </div>


    <div class="footer">
        <div class="footer-section left-footer">
            <h2>About Us</h2>
            <p>FloodAidHub is a crowdfunding platform dedicated to supporting flood relief efforts and helping
                communities recover from natural disasters. Our mission is to empower individuals, organizations, and
                communities to create and fund impactful relief projects that make a real difference.</p>
        </div>

        <div class="footer-section right-footer">
            <h2>Contact Us</h2>
            <p>Email: support@floodaidhub.com</p>
            <p>Phone: 01720833609</p>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function () {

            fetch("getCampaigns.php")
                .then(response => response.json())
                .then(data => {
                    const campaignGrid = document.querySelector(".campaign-grid");
                    campaignGrid.innerHTML = ""; 

                    
                    data.forEach(campaign => {
                        const progress = (campaign.raised_amount / campaign.target_amount) * 100;

                        const campaignCard = `
                    <div class="campaign-card">
                        <img src="${campaign.image_url}" alt="Campaign Image">
                        <h3>${campaign.goal}</h3>
                        <p>$${campaign.raised_amount} raised of $${campaign.target_amount} goal</p>
                        <div class="progress-bar">
                            <div class="progress-bar-inner" style="width: ${progress}%"></div>
                        </div>
                    </div>
                `;
                        campaignGrid.innerHTML += campaignCard;
                    });
                })
                .catch(error => {
                    console.error("Error fetching campaigns:", error);
                    const campaignGrid = document.querySelector(".campaign-grid");
                    campaignGrid.innerHTML = "<p>Failed to load campaigns. Please try again later.</p>";
                });
        });
    </script>

</body>

</html>