<?php
$array = [10, 20, 30, 40, 50];
$search = 25;

if (in_array($search, $array)) {
    echo "$search is found in the array\n";
} else {
    echo "$search is not found in the array\n";
}
?>