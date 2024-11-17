<?php
$a = 10;
$b = 20;
$c = 15;

if ($a > $b && $a > $c) {
    echo "Largest number is: $a\n";
} elseif ($b > $c) {
    echo "Largest number is: $b\n";
} else {
    echo "Largest number is: $c\n";
}
?>