<?php

declare(strict_types=1);

namespace Jean85\ValueObjectPlayground;

use Facile\PhpCodec\Decoder;
use Facile\PhpCodec\Validation\Validation;

/**
 * @template T of Dto
 */
abstract class Dto
{
    /**
     * @return Validation<T>
     */
    abstract public static function create(mixed $data): Validation;

    /**
     * @return Decoder<mixed, T>
     */
    abstract protected static function getDecoder(): Decoder;
}
