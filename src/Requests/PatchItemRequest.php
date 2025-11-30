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
 *     _ycode_id: string,
 * }
 */
final class PatchItemRequest extends Request implements HasBody
{
    use HasJsonBody, HasTimeout;

    protected Method $method = Method::PATCH;

    public function __construct(
        private readonly string $collectionId,
        private readonly string $itemId,
        private readonly array $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/collections/{$this->collectionId}/items/{$this->itemId}";
    }

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
