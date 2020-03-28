<?php

/**
 * @param int $start
 * @param int $end
 * @return int
 * @throws Exception
 */
function smallest(int $start, int $end): array {
    $products = _get_palindrome_products($start, $end);

    $min_product = min(array_keys($products));

    return [$min_product, $products[$min_product]];
}

/**
 * @param int $start
 * @param int $end
 * @return int
 * @throws Exception
 */
function largest(int $start, int $end): array {
   $products = _get_palindrome_products($start, $end);

    $max_product = max(array_keys($products));

    return [$max_product, $products[$max_product]];
}

/**
 * @param int $start
 * @param int $end
 * @return array
 * @throws Exception
 */
function _get_palindrome_products(int $start, int $end): array {
    if ($start > $end) {
        throw new Exception('Start of the range cannot be largest than its end');
    }

    $products = [];
    for ($i = $start; $i <= $end; $i++) {
        for ($j = $i; $j <= $end; $j++) {
            $product = $i * $j;
            if (_is_palindrome($product)) {
                $products[$product][] = [$i, $j];
            }

        }
    }

    if( empty($products)) {
        throw new Exception('Cannot find any palindrome product');
    }

    return $products;
}

function _is_palindrome(string $value): bool {
    if(1 === strlen($value)) {
        return true;
    }

    $array_chars = str_split($value);
    $chars_number = count($array_chars);

    $first_chunk = array_splice($array_chars, 0, floor($chars_number / 2));
    $last_chunk = 0 === $chars_number % 2 ? $array_chars : array_splice($array_chars, 1);

    return $first_chunk === array_reverse($last_chunk);
}