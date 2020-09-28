<?php

/**
 * @file
 * Contains FastFrame\Utility\SimpleCache\MemoryTest
 */

namespace FastFrame\Utility\SimpleCache;

/**
 * SimpleCache memory based caching
 *
 * @NOTE    This is implemented here as I wasn't able to find a good PSR Memory based cache implementation
 *
 * @package FastFrame\Utility\SimpleCache
 */
class MemoryTest
	extends SimpleCacheTest
{
	const TTL_NOT_SUPPORTED = "TTL not supported";

	protected $skippedTests = [
		'testSetTtl'                     => self::TTL_NOT_SUPPORTED,
		'testSetExpiredTtl'              => self::TTL_NOT_SUPPORTED,
		'testSetMultipleTtl'             => self::TTL_NOT_SUPPORTED,
		'testSetMultipleExpiredTtl'      => self::TTL_NOT_SUPPORTED,
		'testSetInvalidTtl'              => self::TTL_NOT_SUPPORTED,
		'testSetMultipleInvalidTtl'      => self::TTL_NOT_SUPPORTED,
		'testObjectDoesNotChangeInCache' => 'Memory based without serialization'
	];

	public function createSimpleCache()
	{
		return new Memory();
	}
}