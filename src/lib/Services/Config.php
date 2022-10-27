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

namespace Local\Services;

class Config implements \ArrayAccess
{
    /**
     * @var array|mixed
     */
    private array $config = [];

    /**
     * @param string $configFile
     */
    public function __construct(protected string $configFile)
    {
        if (!file_exists($this->configFile)) {
            throw new \InvalidArgumentException('Config File Not Exists!');
        }
        $this->config = json_decode(file_get_contents($this->configFile), true);
    }

    /**
     * @param string $configFile
     *
     * @return bool
     */
    public function merge(string $configFile)
    : bool {
        if (!file_exists($configFile)) {
            throw new \InvalidArgumentException('Merge File Not Exists');
        }
        $config = json_decode(file_get_contents($configFile), true);

        $this->config = array_merge_recursive($this->config, $config);

        return true;
    }

    /**
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists(mixed $offset)
    : bool {
        return $this->exists($this->config, $offset);
    }

    /**
     * @param array $array
     * @param mixed $key
     *
     * @return bool
     */
    protected function exists(array $array, mixed $key)
    : bool {
        if (isset($array[$key])) {
            return true;
        }

        $arrayValue = $this->traverseArray($array, $key);

        return isset($arrayValue);
    }

    /**
     * @param array $array
     * @param mixed $key
     *
     * @return mixed
     */
    protected function traverseArray(array $array, mixed $key)
    : mixed {
        foreach (explode('.', $key) as $part) {
            if (!is_array($array) or !isset($array[$part])) {
                return null;
            }
            $array = $array[$part];
        }

        return $array;
    }

    /**
     * @param mixed $offset
     *
     * @return mixed
     */
    public function offsetGet(mixed $offset)
    : mixed {
        return $this->retrieve($this->config, $offset);
    }

    /**
     * @param array $array
     * @param mixed $key
     *
     * @return mixed
     */
    protected function retrieve(array $array, mixed $key)
    : mixed {
        if (isset($array[$key])) {
            return $array[$key];
        }

        return $this->traverseArray($array, $key);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     *
     * @return void
     */
    public function offsetSet(mixed $offset, mixed $value)
    : void {
        throw new \BadMethodCallException('Config is immutable');
    }

    /**
     * @param mixed $offset
     *
     * @return void
     */
    public function offsetUnset(mixed $offset)
    : void {
        throw new \BadMethodCallException('Config is immutable');
    }

}