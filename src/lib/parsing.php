<?php
/**
 * Parses an integer from an input string.
 *
 * @param string $input The input string to parse
 * @param int $base [optional] The base for the conversion
 * @return int|null If `$input` is a numeric input, the parsed number will be returned. Otherwise `null` is returned.
 */
function parse_int(string $input, $base = 10): ?int {
    if (!is_numeric($input)) {
        return null;
    }

    return intval($input, $base);
}

/**
 * Parses either a JSON array or CSV array.
 *
 * @param string $input The input string to parse
 * @return array The parsed array from the input string.
 */
function parse_array(string $input): array {
    $array = json_decode($input);
    if ($array !== null) {
        return $array;
    }

    return str_getcsv($input);
}
