<?php

declare(strict_types=1);

namespace RashidLaasri\YCODE\DataObjects;

use Carbon\Carbon;

final readonly class Item
{
    public function __construct(
        public string $_ycode_id,
        public int $id,
        public string $name,
        public string $slug,
        public Carbon $created_at,
        public Carbon $updated_at,
        public string $created_by,
        public string $updated_by,
        public string $summary,
        public string $main_image,
        public string $thumbnail,
        public int $featured,
        public string $author,
        public array $categories,
        public string $body,
    ) {}
}
