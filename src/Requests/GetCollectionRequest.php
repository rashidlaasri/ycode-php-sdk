<?php

declare(strict_types=1);

namespace RashidLaasri\YCODE\Requests;

use Carbon\Carbon;
use RashidLaasri\YCODE\DataObjects\Collection;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Plugins\HasTimeout;

/**
 * @phpstan-type CollectionResponseType array{
 *     _ycode_id: string,
 *     name: string,
 *     singular_name: string,
 *     created_at: string,
 *     fields: array<int, array{
 *         id: int,
 *         name: string,
 *         type: string,
 *         default: string|null
 *     }>
 * }
 */
final class GetCollectionRequest extends Request
{
    use HasTimeout;

    protected Method $method = Method::GET;

    public function __construct(private readonly string $id) {}

    public function resolveEndpoint(): string
    {
        return "/collections/{$this->id}";
    }

    public function createDtoFromResponse(Response $response): Collection
    {
        /** @var CollectionResponseType $collection */
        $collection = $response->json()['data'];

        return new Collection(
            _ycode_id: $collection['_ycode_id'],
            name: $collection['name'],
            singular_name: $collection['singular_name'],
            created_at: Carbon::parse($collection['created_at']),
            fields: $collection['fields'],
        );
    }
}
