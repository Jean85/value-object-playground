<?php

declare(strict_types=1);

use Facile\PhpCodec\Validation\ValidationFailures;
use Facile\PhpCodec\Validation\ValidationSuccess;
use Jean85\ValueObjectPlayground\ValueObjects\Age;
use PHPUnit\Framework\TestCase;

/**
 * @covers Age
 */
class AgeTest extends TestCase
{
    public function testAge(): void
    {
        $validation = Age::create(42);

        $this->assertInstanceOf(ValidationSuccess::class, $validation);
        $this->assertInstanceOf(Age::class, $validation->getValue());
    }

    /**
     * @dataProvider invalidDataProvider
     */
    public function testAgeInvalid(mixed $input): void
    {
        $validation = Age::create($input);

        $this->assertInstanceOf(ValidationFailures::class, $validation);
    }

    /**
     * @return array{mixed}[]
     */
    public function invalidDataProvider(): array
    {
        return [
            [false],
            [41],
            [42.0],
        ];
    }
}
