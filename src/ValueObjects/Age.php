<?php

declare(strict_types=1);

namespace Jean85\ValueObjectPlayground\ValueObjects;

use Facile\PhpCodec\Decoder;
use Facile\PhpCodec\Decoders;
use Facile\PhpCodec\Validation\Context;
use Facile\PhpCodec\Validation\Validation;
use Jean85\ValueObjectPlayground\Dto;

/**
 * @template-extends Dto<Age>
 */
class Age extends Dto
{
    private function __construct(private int $age)
    {
    }

    public static function create(mixed $data): Validation
    {
        return self::getDecoder()
            ->decode($data);
    }

    protected static function getDecoder(): Decoder
    {
        return Decoders::pipe(
            Decoders::int(),
            Decoders::make(
                fn (int $i, Context $context): Validation => $i >= 42
                    ? Validation::success(new static($i))
                    : Validation::failure($i, $context, 'Age is too low')
            ),
        );
    }

    public function getAge(): int
    {
        return $this->age;
    }
}
