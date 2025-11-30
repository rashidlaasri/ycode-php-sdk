<?php

declare(strict_types=1);

namespace RashidLaasri\YCODE\Requests;

use RashidLaasri\YCODE\DataObjects\Item;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;
use Saloon\Traits\Plugins\HasTimeout;

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
class ListItemsRequest extends Request implements Paginatable
{
    use HasTimeout;

    protected Method $method = Method::GET;

    /**
     * @param  array<mixed>  $queryParams
     */
    public function __construct(
        private readonly string $collectionId,
        private readonly array $queryParams,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/collections/{$this->collectionId}/items";
    }

    /**
     * @return array<mixed>
     */
    protected function defaultQuery(): array
    {
        return $this->queryParams;
    }

    /**
     * @return array<Item>
     */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<ItemResponseType> $items */
        $items = $response->json('data');

        return array_map(Item::fromResponse(...), $items);
    }
}
