<?php

declare(strict_types=1);

namespace RashidLaasri\YCODE\Requests;

use RashidLaasri\YCODE\DataObjects\Item;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;
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
final class CreateItemRequest extends Request implements HasBody
{
    use HasJsonBody, HasTimeout;

    protected Method $method = Method::POST;

    /**
     * @param  array<mixed>  $payload
     */
    public function __construct(
        private readonly string $collectionId,
        private readonly array $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/collections/{$this->collectionId}/items";
    }

    /**
     * @return array<mixed>
     */
    protected function defaultBody(): array
    {
        return $this->payload;
    }

    public function createDtoFromResponse(Response $response): Item
    {
        /** @var ItemResponseType $item */
        $item = $response->json('data');

        return Item::fromResponse($item);
    }
}
