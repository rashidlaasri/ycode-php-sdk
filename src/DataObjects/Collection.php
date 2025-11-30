<?php

declare(strict_types=1);

namespace RashidLaasri\YCODE\DataObjects;

use Carbon\Carbon;

/**
 * @phpstan-type FieldType array{
 *     id: int,
 *     name: string,
 *     type: string,
 *     default: string|null
 * }
 */
final readonly class Collection
{
    /**
     * @param  array<int, FieldType>  $fields
     */
    public function __construct(
        public string $_ycode_id,
        public string $name,
        public string $singular_name,
        public Carbon $created_at,
        public array $fields = [],
    ) {}
}
