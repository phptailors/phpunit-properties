<?php declare(strict_types=1);

/*
 * This file is part of phptailors/phpunit-extensions.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\PHPUnit;

use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use Tailors\PHPUnit\Constraint\ObjectPropertiesIdenticalTo;
use Tailors\PHPUnit\Constraint\ProvObjectPropertiesTrait;

/**
 * @small
 *
 * @covers \Tailors\PHPUnit\ObjectPropertiesIdenticalToTrait
 *
 * @internal This class is not covered by the backward compatibility promise
 *
 * @psalm-internal Tailors\PHPUnit
 */
final class ObjectPropertiesIdenticalToTraitTest extends TestCase
{
    use ObjectPropertiesIdenticalToTrait;
    use ProvObjectPropertiesTrait;

    public static function createConstraint(...$args): ObjectPropertiesIdenticalTo
    {
        return ObjectPropertiesIdenticalTo::create(...$args);
    }

    /**
     * @dataProvider provObjectPropertiesIdenticalTo
     */
    public function testObjectPropertiesIdenticalTo(array $expect, object $actual, string $string)
    {
        self::assertThat($actual, self::objectPropertiesIdenticalTo($expect));
    }

    /**
     * @dataProvider provObjectPropertiesNotEqualTo
     * @dataProvider provObjectPropertiesEqualButNotIdenticalTo
     */
    public function testLogicalNotObjectPropertiesIdenticalTo(array $expect, object $actual, string $string)
    {
        self::assertThat($actual, self::logicalNot(self::objectPropertiesIdenticalTo($expect)));
    }

    /**
     * @dataProvider provObjectPropertiesIdenticalTo
     */
    public function testAssertObjectPropertiesIdenticalTo(array $expect, object $actual, string $string)
    {
        self::assertObjectPropertiesIdenticalTo($expect, $actual);
    }

    /**
     * @dataProvider provObjectPropertiesNotEqualTo
     * @dataProvider provObjectPropertiesEqualButNotIdenticalTo
     */
    public function testAssertObjectPropertiesIdenticalToFails(array $expect, object $actual, string $string)
    {
        $regexp = '/^Lorem ipsum.\n'.
            'Failed asserting that object class\@.+ is an object '.
            'with properties identical to specified./';
        self::expectException(ExpectationFailedException::class);
        self::expectExceptionMessageMatches($regexp);

        self::assertObjectPropertiesIdenticalTo($expect, $actual, 'Lorem ipsum.');
    }

    /**
     * @dataProvider provObjectPropertiesNotEqualTo
     */
    public function testAssertNotObjectPropertiesIdenticalTo(array $expect, object $actual, string $string)
    {
        self::assertNotObjectPropertiesIdenticalTo($expect, $actual);
    }

    /**
     * @dataProvider provObjectPropertiesIdenticalTo
     */
    public function testAssertNotObjectPropertiesIdenticalToFails(array $expect, object $actual, string $string)
    {
        $regexp = '/^Lorem ipsum.\n'.
            'Failed asserting that object class@.+ fails to be an object '.
            'with properties identical to specified./';
        self::expectException(ExpectationFailedException::class);
        self::expectExceptionMessageMatches($regexp);

        self::assertNotObjectPropertiesIdenticalTo($expect, $actual, 'Lorem ipsum.');
    }
}

// vim: syntax=php sw=4 ts=4 et:
