<?php

declare(strict_types=1);
/**
 * Provide the test data to the data providers
 *
 * Date: 10/26/2022
 *
 * @author  Charles Brookover
 * @license MIT
 * @version 0.0.1
 */

namespace Local\Test\Build;

class Data
{

    private array $data = [];

    public function __construct(
        private readonly string $className,
        ?string $dataFile = null,
        bool $useClassName = true
    ) {
        if (empty($dataFile)) {
            $dataFile = realpath(dirname(__FILE__) . '/../data/data.json');
        }
        if (file_exists($dataFile)) {
            $jsonData = json_decode(file_get_contents($dataFile), true);

            $this->data = $this->setTestData($jsonData, $useClassName);
        }
    }

    protected function setTestData(array $data, bool $useClassName)
    : array {
        if ($useClassName) {
            if ($pos = strrpos($this->className, '\\')) {
                $className = substr($this->className, $pos + 1);
            } else {
                $className = $this->className;
            }

            $testData = $data[$className] ?? [];
        } else {
            $testData = $data;
        }

        return $testData;
    }

    public function getTestData(?string $key = null)
    : mixed {
        return isset($key) ? ($this->data[$key] ?? null) : $this->data;
    }
}