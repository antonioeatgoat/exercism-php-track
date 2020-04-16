<?php

// The cost of a single book
const COST_SINGLE = 8.0;

// The absolute value of the discount on each book for each books group
const DISCOUNTS = [2 => 0.40, 3 => 0.8, 4 => 1.60, 5 => 2.0];

function total(array $basket): float {
    $groups = _make_groups($basket);

    $total = 0;
    foreach( $groups as $group ) {
        $total += _calculate_group_cost($group);
    }

    return $total;
}

function _make_groups(array $basket): array {
    $groups = [];

    foreach ($basket as $book) {
        $added = false;
        foreach( $groups as &$group ) {
            if( ! in_array($book, $group)) {
                $group[] = $book;
                $added = true;
                break;
            }
        }

        if ( ! $added ) {
            $groups[] = [$book];
        }

        sort($groups);
    }

    return $groups;
}

function _calculate_group_cost( array $books ): float {
    $group_count = count($books);
    $group_cost  = COST_SINGLE * $group_count;

    if ($group_count < 2) {
        return $group_cost;
    }

    return $group_cost-$group_count*DISCOUNTS[$group_count];
}