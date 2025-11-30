<?php

declare(strict_types=1);

namespace RashidLaasri\YCODE\Resources;

use RashidLaasri\YCODE\DataObjects\Item;
use RashidLaasri\YCODE\Requests\CreateItemRequest;
use RashidLaasri\YCODE\Requests\DeleteItemRequest;
use RashidLaasri\YCODE\Requests\GetItemRequest;
use RashidLaasri\YCODE\Requests\ListItemsRequest;
use RashidLaasri\YCODE\Requests\PatchItemRequest;
use RashidLaasri\YCODE\Requests\UpdateItemRequest;
use RashidLaasri\YCODE\YCode;
use Saloon\Http\BaseResource;
use Saloon\PaginationPlugin\PagedPaginator;

final class ItemResource extends BaseResource
{
    /**
     * @param  array<mixed>  $queryParams
     */
    public function list(string $collectionId, array $queryParams = []): PagedPaginator
    {
        /** @var YCode $connector */
        $connector = $this->connector;

        return $connector->paginate(new ListItemsRequest($collectionId, $queryParams));
    }

    public function get(string $collectionId, string $itemId): Item
    {
        /** @var Item $response */
        $response = $this->connector
            ->send(new GetItemRequest($collectionId, $itemId))
            ->dto();

        return $response;
    }

    /**
     * @param  array<mixed>  $payload
     */
    public function create(string $collectionId, array $payload): Item
    {
        /** @var Item $response */
        $response = $this->connector
            ->send(new CreateItemRequest($collectionId, $payload))
            ->dto();

        return $response;
    }

    /**
     * @param  array<mixed>  $payload
     */
    public function update(string $collectionId, string $itemId, array $payload): Item
    {
        /** @var Item $response */
        $response = $this->connector
            ->send(new UpdateItemRequest($collectionId, $itemId, $payload))
            ->dto();

        return $response;
    }

    /**
     * @param  array<mixed>  $payload
     */
    public function patch(string $collectionId, string $itemId, array $payload): Item
    {
        /** @var Item $response */
        $response = $this->connector
            ->send(new PatchItemRequest($collectionId, $itemId, $payload))
            ->dto();

        return $response;
    }

    /**
     * @param  array<mixed>  $payload
     * @return array{deleted: int}
     */
    public function delete(string $collectionId, string $itemId, array $payload): array
    {
        /** @var array{deleted: int} $response */
        $response = $this->connector
            ->send(new DeleteItemRequest($collectionId, $itemId, $payload))
            ->dto();

        return $response;
    }
}
