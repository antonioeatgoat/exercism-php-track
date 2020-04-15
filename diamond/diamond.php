<?php

function diamond( $letter ): array {
    $letters = range('A', 'Z');

    $bottom_diamond = [];

    $letter_index = array_search( $letter, $letters );

    for($i = $letter_index; $i >= 0; $i-- ) {
        $n_spaces_around = $letter_index-$i;
        $n_spaces_between = $i;

        $spaces_around = str_repeat( ' ', $n_spaces_around );
        $spaces_between = str_repeat( ' ', $n_spaces_between );

        $left_side = $spaces_around . $letters[$i] . $spaces_between;
        $right_side = substr(strrev($left_side), 1);
        $bottom_diamond[] = $left_side . $right_side;
    }

    $top_diamond = array_reverse(array_slice($bottom_diamond, 1));

    return array_merge( $top_diamond, $bottom_diamond);

}