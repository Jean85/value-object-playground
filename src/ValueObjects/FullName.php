<?php

declare(strict_types=1);

namespace Jean85\ValueObjectPlayground\ValueObjects;

use Facile\PhpCodec\Decoder;
use Facile\PhpCodec\Decoders;
use Jean85\ValueObjectPlayground\Dto;

/**
 * @extends Dto<FullName>
 */
final class FullName extends Dto
{
    private function __construct(
        private string $firstName,
        private string $lastName,
    ) {
    }

    protected static function getDecoder(): Decoder
    {
        return Decoders::classFromArrayPropsDecoder(
            Decoders::arrayProps([
                'firstName' => Decoders::string(),
                'lastName' => Decoders::string(),
            ]),
            fn (string $firstName, string $lastName): FullName => new static($firstName, $lastName),
            __CLASS__,
        );
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }
}
