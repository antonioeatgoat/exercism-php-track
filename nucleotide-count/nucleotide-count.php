<?php

function nucleotideCount( string $sequence ) {
    $sequence = strtolower($sequence);
    $nucleotides = [ 'a' => 0, 'c' => 0, 't' => 0, 'g' => 0];

    if( empty( $sequence ) ) {
        return $nucleotides;
    }

    foreach( str_split($sequence) as $nucleotide ) {
        $nucleotides[$nucleotide] +=1;
    }

    return $nucleotides;
}