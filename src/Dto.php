<?php

declare(strict_types=1);

namespace Jean85\ValueObjectPlayground;

use Facile\PhpCodec\Decoder;
use Facile\PhpCodec\Validation\Validation;

/**
 * @template T
 */
abstract class Dto
{
    /**
     * @return Validation<T>
     */
    final public static function create(mixed $data): Validation
    {
        return static::getDecoder()
            ->decode($data);
    }

    /**
     * @return Decoder<mixed, T>
     */
    abstract protected static function getDecoder(): Decoder;
}
