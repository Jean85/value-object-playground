<?php

declare(strict_types=1);

namespace Jean85\ValueObjectPlayground\ValueObjects;

use Facile\PhpCodec\Decoder;
use Facile\PhpCodec\Decoders;
use Facile\PhpCodec\Validation\Context;
use Facile\PhpCodec\Validation\Validation;
use Jean85\ValueObjectPlayground\Dto;

final class Age extends Dto
{
    private function __construct(private int $age)
    {
    }

    protected static function getDecoder(): Decoder
    {
        return Decoders::pipe(
            Decoders::int(),
            /** @psalm-var Decoder<int, self> */
            Decoders::make(
                fn (int $i, Context $context): Validation => $i >= 42
                    ? Validation::success(new self($i))
                    : Validation::failure($i, $context, 'Age is too low')
            ),
        );
    }

    public function getAge(): int
    {
        return $this->age;
    }
}
