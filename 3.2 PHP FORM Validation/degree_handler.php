<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $degrees = $_POST['degree'];

    if (empty($degrees) || count($degrees) < 2) {
        echo "Error: At least two degrees must be selected.";
    } else {
        echo "Degrees: " . implode(", ", array_map('htmlspecialchars', $degrees));
    }
}
?>