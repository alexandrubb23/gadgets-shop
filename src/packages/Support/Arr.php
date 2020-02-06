<?php

namespace AlxCart\Support;

class Arr
{
    /**
     * Determine if is a multi dimensional array.
     *
     * @param  array   $data
     * @return boolean
     */
    public static function isMulti(array $array)
    {
        rsort($array);
        return isset($array[0]) && is_array($array[0]);
    }

    /**
     * Convert multi-dimensional array into a single-dimensional array.
     *
     * @param  array  $array
     * @param  bool   $unique
     * @param  array  $result
     * @return array
     */
    public static function flatten(array $array, bool $unique = true, $result = [])
    {
        if (! self::isMulti($array)) {
            return $array;
        }

        foreach ($array as $item) {
            if (is_array($item)) {
                $result = array_merge($result, self::flatten($item));
            } else {
                $result[] = $item;
            }
        }

        if ($unique) {
            return array_unique($result);
        }

        return $result;
    }
}
