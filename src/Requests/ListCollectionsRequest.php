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
 *     created_at: string
 * }
 */
class ListCollectionsRequest extends Request
{
    use HasTimeout;

    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/collections';
    }

    /**
     * @return array<Collection>
     */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<CollectionResponseType> $collections */
        $collections = $response->json()['data'];

        return array_map([$this, 'map'], $collections);
    }

    /**
     * @param  CollectionResponseType  $collection
     */
    protected function map(array $collection): Collection
    {
        return new Collection(
            _ycode_id: (string) $collection['_ycode_id'],
            name: (string) $collection['name'],
            singular_name: (string) $collection['singular_name'],
            created_at: Carbon::parse($collection['created_at']),
        );
    }
}
