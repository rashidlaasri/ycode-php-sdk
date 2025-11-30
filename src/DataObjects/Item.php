<?php

declare(strict_types=1);

namespace RashidLaasri\YCODE\DataObjects;

use Carbon\Carbon;

final readonly class Item
{
    public function __construct(
        public string $_ycode_id,
        public int $id,
        public ?string $name,
        public ?string $slug,
        public ?Carbon $created_at,
        public ?Carbon $updated_at,
        public ?string $created_by,
        public ?string $updated_by,
        public ?string $summary,
        public ?string $main_image,
        public ?string $thumbnail,
        public ?int $featured,
        public ?string $author,
        public ?array $categories,
        public ?string $body,
    ) {}

    public static function fromResponse(array $response): self
    {
        return new self(
            _ycode_id: (string) $response['_ycode_id'],
            id: $response['ID'],
            name: $response['Name'] ?? null,
            slug: $response['Slug'] ?? null,
            created_at: isset($response['Created date']) ? Carbon::parse($response['Created date']) : null,
            updated_at: isset($response['Updated date']) ? Carbon::parse($response['Updated date']) : null,
            created_by: $response['Created by'] ?? null,
            updated_by: $response['Updated by'] ?? null,
            summary: $response['Summary'] ?? null,
            main_image: $response['Main Image'] ?? null,
            thumbnail: $response['Thumbnail Image'] ?? null,
            featured: $response['Featured'] ?? null,
            author: $response['Author'] ?? null,
            categories: array_map(Category::fromResponse(...), $response['Categories'] ?? []),
            body: $response['Body'] ?? null,
        );
    }
}
