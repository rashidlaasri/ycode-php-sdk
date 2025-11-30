<?php

declare(strict_types=1);

namespace RashidLaasri\YCODE\DataObjects;

use Carbon\Carbon;

/**
 * @phpstan-type ItemResponseType array{
 *     "_ycode_id": string|null,
 *     "ID": int|null,
 *     "Name": string|null,
 *     "Slug": string|null,
 *     "Created date": string|null,
 *     "Updated date": string|null,
 *     "Created by": string|null,
 *     "Updated by": string|null,
 *     "Summary": string|null,
 *     "Main Image": string|null,
 *     "Thumbnail Image": string|null,
 *     "Featured": bool,
 *     "Author": string|null,
 *     "Categories": string[]|null,
 *     "Body": string|null
 * }
 */
final readonly class Item
{
    /**
     * @param  array<Category>|null  $categories
     */
    public function __construct(
        public string $_ycode_id,
        public ?int $id,
        public ?string $name,
        public ?string $slug,
        public ?Carbon $created_at,
        public ?Carbon $updated_at,
        public ?string $created_by,
        public ?string $updated_by,
        public ?string $summary,
        public ?string $main_image,
        public ?string $thumbnail,
        public bool $featured,
        public ?string $author,
        public ?array $categories,
        public ?string $body,
    ) {}

    /**
     * Create item instance form array.
     *
     * @param  ItemResponseType  $item
     */
    public static function fromResponse(array $item): self
    {
        return new self(
            _ycode_id: (string) $item['_ycode_id'],
            id: $item['ID'] ?? null,
            name: $item['Name'] ?? null,
            slug: $item['Slug'] ?? null,
            created_at: isset($item['Created date']) ? Carbon::parse($item['Created date']) : null,
            updated_at: isset($item['Updated date']) ? Carbon::parse($item['Updated date']) : null,
            created_by: $item['Created by'] ?? null,
            updated_by: $item['Updated by'] ?? null,
            summary: $item['Summary'] ?? null,
            main_image: $item['Main Image'] ?? null,
            thumbnail: $item['Thumbnail Image'] ?? null,
            featured: (bool) $item['Featured'],
            author: $item['Author'] ?? null,
            categories: array_map(Category::fromResponse(...), $item['Categories'] ?? []),
            body: $item['Body'] ?? null,
        );
    }
}
