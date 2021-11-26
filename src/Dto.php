<?php

declare(strict_types=1);

namespace Jean85\ValueObjectPlayground;

use Facile\PhpCodec\Decoder;
use Facile\PhpCodec\Validation\Validation;

abstract class Dto
{
    /**
     * @return Validation<static>
     */
    final public static function create(mixed $data): Validation
    {
        return static::getDecoder()
            ->decode($data);
    }

    /**
     * @return Decoder<mixed, static>
     */
    abstract protected static function getDecoder(): Decoder;
}
