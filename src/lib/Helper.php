<?php

declare(strict_types=1);
/**
 * A new PHP page
 *
 * Date: 10/24/2022
 *
 * @author  Charles Brookover
 * @license MIT
 * @version 0.0.1
 */

namespace Local;

class Helper
{
    public static function hashPassword(string $password)
    : string {
        return hash('sha512', $password);
    }
}