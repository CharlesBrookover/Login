<?php

declare(strict_types=1);
/**
 * A new PHP page
 *
 * Date: 10/27/2022
 *
 * @author  Charles Brookover
 * @license MIT
 * @version 0.0.1
 */

namespace Local\Test\Build;

class Helpers
{
    public static function expandPath(string $path)
    : string {
        preg_match_all('/%(?<constant>[A-Z_]+)?%/', $path, $matches, PREG_PATTERN_ORDER);

        $newPath = '';
        foreach ($matches['constant'] as $constant) {
            $newPath = preg_replace('/%' . $constant . '%/', constant($constant), $path);
        }

        return empty($newPath) ? $path : $newPath;
    }
}