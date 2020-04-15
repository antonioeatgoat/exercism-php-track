<?php

function isArmstrongNumber(int $number): bool {
    $sum = 0;

    $n_digits = strlen($number);
    foreach( str_split($number) as $i => $digit ) {
        $sum += pow($digit, $n_digits);
    }

    return $sum == $number;
}