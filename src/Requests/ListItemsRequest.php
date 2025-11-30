<?php

declare(strict_types=1);

namespace RashidLaasri\YCODE\Requests;

use Carbon\Carbon;
use RashidLaasri\YCODE\DataObjects\Item;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;
use Saloon\Traits\Plugins\HasTimeout;

/**
 * @phpstan-type ItemResponseType array{
 *     _ycode_id: string,
 * }
 */
class ListItemsRequest extends Request implements Paginatable
{
    use HasTimeout;

    protected Method $method = Method::GET;

    public function __construct(private readonly string $collectionId) {}

    public function resolveEndpoint(): string
    {
        return "/collections/{$this->collectionId}/items";
    }

    /**
     * @return array<Item>
     */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<ItemResponseType> $items */
        $items = $response->json('data');

        return array_map([$this, 'map'], $items);
    }

    /**
     * @param  ItemResponseType  $item
     */
    protected function map(array $item): Item
    {
        return new Item(
            _ycode_id: (string) $item['_ycode_id'],
            id: $item['ID'],
            name: $item['Name'],
            slug: $item['Slug'],
            created_at: Carbon::parse($item['Created date']),
            updated_at: Carbon::parse($item['Updated date']),
            created_by: $item['Created by'],
            updated_by: $item['Updated by'],
            summary: $item['Summary'],
            main_image: $item['Main Image'],
            thumbnail: $item['Thumbnail Image'],
            featured: $item['Featured'],
            author: $item['Author'],
            categories: $item['Categories'],
            body: $item['Body'],
        );
    }
}
