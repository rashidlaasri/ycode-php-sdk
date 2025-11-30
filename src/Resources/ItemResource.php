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
use Saloon\Http\BaseResource;

final class ItemResource extends BaseResource
{
    public function list(string $collectionId, array $queryParams = [])
    {
        return $this->connector
            ->paginate(new ListItemsRequest($collectionId, $queryParams));
    }

    public function get(string $collectionId, string $itemId): Item
    {
        return $this->connector
            ->send(new GetItemRequest($collectionId, $itemId))
            ->dto();
    }

    public function create(string $collectionId, array $payload): Item
    {
        return $this->connector
            ->send(new CreateItemRequest($collectionId, $payload))
            ->dto();
    }

    public function update(string $collectionId, string $itemId, array $payload): Item
    {
        return $this->connector
            ->send(new UpdateItemRequest($collectionId, $itemId, $payload))
            ->dto();
    }

    public function patch(string $collectionId, string $itemId, array $payload): Item
    {
        return $this->connector
            ->send(new PatchItemRequest($collectionId, $itemId, $payload))
            ->dto();
    }

    public function delete(string $collectionId, string $itemId, array $payload): array
    {
        return $this->connector
            ->send(new DeleteItemRequest($collectionId, $itemId, $payload))
            ->dto();
    }
}
