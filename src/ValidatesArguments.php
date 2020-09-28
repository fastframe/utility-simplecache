<?php

/**
 * @file
 * Contains FastFrame\Utility\SimpleCache\ValidatesKey
 */

namespace FastFrame\Utility\SimpleCache;

use FastFrame\Utility\SimpleCache\Exception\InvalidArgument;
use Traversable;

/**
 * Provides a trait to validate the key
 */
trait ValidatesArguments
{
	/**
	 * @param string $key
	 *
	 * @return mixed
	 */
	protected function validKey($key)
	{
		if (is_integer($key) || is_string($key)) {
			if (is_numeric($key)) {
				return $key;
			}

			if (!empty($key) && preg_match('/^[a-zA-Z0-9-_.]{1,}$/', $key)) {
				return $key;
			}
		}

		$type = get_debug_type($key);

		throw new InvalidArgument("Invalid key: " . ($type === 'string' ? $key : $type));
	}

	/**
	 * Validates the iterator and returns it
	 *
	 * @param array|Traversable $ary
	 *
	 * @return array|Traversable
	 */
	protected function validIterator($ary)
	{
		if (is_array($ary) || $ary instanceof Traversable) {
			return $ary;
		}

		throw new InvalidArgument("Not an array or Traversable");
	}
}