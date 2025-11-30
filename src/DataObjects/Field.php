<?php

declare(strict_types=1);

namespace RashidLaasri\YCODE\DataObjects;

/**
 * @phpstan-type FieldType array{
 *     id: int,
 *     name: string,
 *     type: string,
 *     default: string|null
 * }
 */
final readonly class Field
{
    public function __construct(
        public int $id,
        public string $name,
        public string $type,
        public ?string $default_value,
    ) {}

    /**
     * Create field instance form array.
     *
     * @param  FieldType  $field
     */
    public static function fromArray(array $field): self
    {
        return new self(
            id: $field['id'],
            name: $field['name'],
            type: $field['type'],
            default_value: $field['default'],
        );
    }
}
