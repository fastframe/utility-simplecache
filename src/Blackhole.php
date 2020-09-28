<?php

/**
 * @file
 * Contains FastFrame\Utility\SimpleCache\Blackhole
 */

namespace FastFrame\Utility\SimpleCache;

use Psr\SimpleCache\CacheInterface;

/**
 * SimpleCache based Null implementation
 *
 * @package FastFrame\Utility\SimpleCache
 */
class Blackhole
	implements CacheInterface
{
	use ValidatesArguments;

	public function get($key, $default = null)
	{
		$this->validKey($key);

		return $default;
	}

	public function set($key, $value, $ttl = null)
	{
		$this->validKey($key);

		return true;
	}

	public function delete($key)
	{
		$this->validKey($key);

		return true;
	}

	public function clear()
	{
		return true;
	}

	public function getMultiple($keys, $default = null)
	{
		$data = [];
		foreach ($this->validIterator($keys) as $key) {
			$data[$this->validKey($key)] = $default;
		}

		return $data;
	}

	public function setMultiple($values, $ttl = null)
	{
		foreach ($this->validIterator($values) as $key => $_) {
			$this->validKey($key);
		}

		return true;
	}

	public function deleteMultiple($keys)
	{
		foreach ($this->validIterator($keys) as $key) {
			$this->validKey($key);
		}

		return true;
	}

	public function has($key)
	{
		$this->validKey($key);

		return false;
	}
}