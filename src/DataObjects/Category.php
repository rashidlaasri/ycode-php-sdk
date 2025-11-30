<?php

declare(strict_types=1);

namespace RashidLaasri\YCODE\DataObjects;

final readonly class Category
{
    public function __construct(
        public string $name,
    ) {}

    /**
     * Create field instance form array.
     */
    public static function fromResponse(string $category): self
    {
        return new self(
            name: $category,
        );
    }
}
