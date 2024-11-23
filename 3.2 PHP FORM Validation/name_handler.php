<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];

    if (empty($name)) {
        echo "Error: Name cannot be empty.";
    } elseif (!preg_match('/^[a-zA-Z][a-zA-Z.\- ]{2,}$/', $name)) {
        echo "Error: Name must contain at least two words, start with a letter, and can contain letters, periods, and dashes only.";
    } else {
        echo "Name: " . htmlspecialchars($name);
    }
}
?>