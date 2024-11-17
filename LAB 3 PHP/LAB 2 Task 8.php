<?php

$array = [
    [1, 2, 3, 'A'],
    [1, 2, 'B', 'C'],
    [1, 'D', 'E', 'F']
];

echo "The Given 2D Array Is:\n";
foreach ($array as $row) {
    foreach ($row as $item) {
        echo "$item ";
    }
    echo "\n";
}

echo "\n";


echo "First Column Is :\n";
echo "1 2 3\n";
echo "12\n";
echo "1\n";

echo "\n";


echo "Second Column Is :\n";
echo "A\n";
echo "B C\n";
echo "D E F\n";
?>

