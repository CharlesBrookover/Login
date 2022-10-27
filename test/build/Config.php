<?php

declare(strict_types=1);
/**
 * A new PHP page
 *
 * Date: 10/26/2022
 *
 * @author  Charles Brookover
 * @license MIT
 * @version 0.0.1
 */

namespace Local\Test\Build;

class Config
{
    private array $config = [];

    public function __construct(protected string $configFile)
    {
        if (file_exists($this->configFile)) {
            $this->config = json_decode(file_get_contents($this->configFile), true);
        }
    }

    public function getConfig(string $key)
    : mixed {
        return $this->config[$key] ?? null;
    }
}