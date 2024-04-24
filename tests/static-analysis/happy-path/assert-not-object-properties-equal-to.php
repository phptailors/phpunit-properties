<?php declare(strict_types=1);

/*
 * This file is part of phptailors/phpunit-extensions.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\PHPUnit\StaticAnalysis\HappyPath\AssertNotObjectPropertiesEqualTo;

use PHPUnit\Framework\ExpectationFailedException;
use Tailors\PHPUnit\InvalidArgumentException;
use Tailors\PHPUnit\ObjectPropertiesEqualToTrait;

class Assert extends \PHPUnit\Framework\Assert
{
    use ObjectPropertiesEqualToTrait;
}

/**
 * @throws ExpectationFailedException
 * @throws InvalidArgumentException
 */
function consume(array $expected, object $object): object
{
    Assert::assertNotObjectPropertiesEqualTo($expected, $object);

    return $object;
}

// vim: syntax=php sw=4 ts=4 et:
