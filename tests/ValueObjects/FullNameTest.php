<?php

declare(strict_types=1);

use Facile\PhpCodec\Validation\ValidationFailures;
use Facile\PhpCodec\Validation\ValidationSuccess;
use Jean85\ValueObjectPlayground\ValueObjects\FullName;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Jean85\ValueObjectPlayground\ValueObjects\FullName
 */
class FullNameTest extends TestCase
{
    public function testFullName(): void
    {
        $validation = FullName::create([
            'firstName' => 'Alessandro',
            'lastName' => 'Lai',
        ]);

        $this->assertInstanceOf(ValidationSuccess::class, $validation);
        $this->assertInstanceOf(FullName::class, $validation->getValue());
    }

    /**
     * @dataProvider invalidDataProvider
     */
    public function testFullNameInvalid(mixed $input): void
    {
        $validation = FullName::create($input);

        $this->assertInstanceOf(ValidationFailures::class, $validation);
    }

    /**
     * @return array{mixed}[]
     */
    public function invalidDataProvider(): array
    {
        return [
            [null],
            [41],
            [['firstName' => 'Alessandro']],
            [['firstName' => 42]],
            [['lastName' => 'Alessandro']],
            [['lastName' => 42]],
            [
                [
                    'firstName' => 'Alessandro',
                    'lastName' => null,
                ],
            ],
        ];
    }
}
