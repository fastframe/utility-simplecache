<?php

/**
 * @file
 * Contains FastFrame\Utility\SimpleCache\BlackholeTest
 */

namespace FastFrame\Utility\SimpleCache;

/**
 * SimpleCache null/void/blackhole based caching
 *
 * @package FastFrame\Utility\SimpleCache
 */
class BlackholeTest
	extends SimpleCacheTest
{
	const TTL_NOT_SUPPORTED     = "TTL not supported";
	const VALUES_IN_NOTHING_OUT = "values aren't set";
	protected $skippedTests = [
		'testSetTtl'                         => self::TTL_NOT_SUPPORTED,
		'testSetExpiredTtl'                  => self::TTL_NOT_SUPPORTED,
		'testSetMultipleTtl'                 => self::TTL_NOT_SUPPORTED,
		'testSetMultipleExpiredTtl'          => self::TTL_NOT_SUPPORTED,
		'testSetInvalidTtl'                  => self::TTL_NOT_SUPPORTED,
		'testSetMultipleInvalidTtl'          => self::TTL_NOT_SUPPORTED,
		'testObjectDoesNotChangeInCache'     => 'Memory based without serialization',
		// we are a blackhole
		'testSet'                            => self::VALUES_IN_NOTHING_OUT,
		'testSetMultiple'                    => self::VALUES_IN_NOTHING_OUT,
		'testSetMultipleWithIntegerArrayKey' => self::VALUES_IN_NOTHING_OUT,
		'testSetMultipleWithGenerator'       => self::VALUES_IN_NOTHING_OUT,
		'testGet'                            => self::VALUES_IN_NOTHING_OUT,
		'testGetMultiple'                    => self::VALUES_IN_NOTHING_OUT,
		'testGetMultipleWithGenerator'       => self::VALUES_IN_NOTHING_OUT,
		'testBasicUsageWithLongKey'          => self::VALUES_IN_NOTHING_OUT,
		'testDataTypeString'                 => self::VALUES_IN_NOTHING_OUT,
		'testDataTypeFloat'                  => self::VALUES_IN_NOTHING_OUT,
		'testDataTypeInteger'                => self::VALUES_IN_NOTHING_OUT,
		'testDataTypeBoolean'                => self::VALUES_IN_NOTHING_OUT,
		'testDataTypeArray'                  => self::VALUES_IN_NOTHING_OUT,
		'testDataTypeObject'                 => self::VALUES_IN_NOTHING_OUT,
		'testBinaryData'                     => self::VALUES_IN_NOTHING_OUT,
		'testSetValidKeys'                   => self::VALUES_IN_NOTHING_OUT,
		'testSetMultipleValidKeys'           => self::VALUES_IN_NOTHING_OUT,
		'testSetValidData'                   => self::VALUES_IN_NOTHING_OUT,
		'testSetMultipleValidData'           => self::VALUES_IN_NOTHING_OUT,
		'testHas'                            => self::VALUES_IN_NOTHING_OUT
	];

	public function createSimpleCache()
	{
		return new Blackhole();
	}

	public function testGetMultiple()
	{
		$result = $this->cache->getMultiple(['key0', 'key1']);
		$keys   = [];
		foreach ($result as $i => $r) {
			$keys[] = $i;
			self::assertNull($r);
		}
		sort($keys);
		self::assertSame(['key0', 'key1'], $keys);

		$this->cache->set('key3', 'value');
		$result = $this->cache->getMultiple(['key2', 'key3', 'key4'], 'foo');
		foreach ($result as $i => $r) {
			self::assertEquals('foo', $r);
		}
	}

	public function testSetMultiple()
	{
		$result = $this->cache->setMultiple(['key0' => 'value0', 'key1' => 'value1']);
		self::assertTrue($result, 'setMultiple() must return true if success');
		self::assertNull($this->cache->get('key0'));
		self::assertNull($this->cache->get('key1'));
	}

	public function testHas()
	{
		self::assertFalse($this->cache->has('key0'));
		$this->cache->set('key0', 'value0');
		self::assertFalse($this->cache->has('key0'));
	}
}