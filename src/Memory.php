<?php

/**
 * @file
 * Contains FastFrame\Utility\SimpleCache\Memory
 */

namespace FastFrame\Utility\SimpleCache;

use Psr\SimpleCache\CacheInterface;

/**
 * SimpleCache memory based caching
 *
 * @NOTE This is implemented here as I wasn't able to find a good PSR Memory based cache implementation
 *
 * @package FastFrame\Utility\SimpleCache
 */
class Memory
	implements CacheInterface
{
	use ValidatesArguments;

	/**
	 * @var array List of keys in memory
	 */
	protected $data = [];

	public function get($key, $default = null)
	{
		return $this->data[$this->validKey($key)] ?? $default;
	}

	public function set($key, $value, $ttl = null)
	{
		$this->data[$this->validKey($key)] = $value;

		return true;
	}

	public function delete($key)
	{
		unset($this->data[$this->validKey($key)]);

		return true;
	}

	public function clear()
	{
		$this->data = [];

		return true;
	}

	public function getMultiple($keys, $default = null)
	{
		$data = [];
		foreach ($this->validIterator($keys) as $key) {
			$data[$key] = $this->data[$this->validKey($key)] ?? $default;
		}

		return $data;
	}

	public function setMultiple($values, $ttl = null)
	{
		foreach ($this->validIterator($values) as $key => $value) {
			$this->data[$this->validKey($key)] = $value;
		}

		return true;
	}

	public function deleteMultiple($keys)
	{
		foreach ($this->validIterator($keys) as $key) {
			unset($this->data[$this->validKey($key)]);
		}

		return true;
	}

	public function has($key)
	{
		return array_key_exists($this->validKey($key), $this->data);
	}
}