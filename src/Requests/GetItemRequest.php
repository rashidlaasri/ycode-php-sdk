<?php

declare(strict_types=1);

namespace RashidLaasri\YCODE\Requests;

use RashidLaasri\YCODE\DataObjects\Item;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
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
final class GetItemRequest extends Request
{
    use HasTimeout;

    protected Method $method = Method::GET;

    public function __construct(
        private readonly string $collectionId,
        private readonly string $itemId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/collections/{$this->collectionId}/items/{$this->itemId}";
    }

    public function createDtoFromResponse(Response $response): Item
    {
        /** @var ItemResponseType $item */
        $item = $response->json('data');

        return Item::fromResponse($item);
    }
}
