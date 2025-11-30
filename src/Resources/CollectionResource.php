<?php

declare(strict_types=1);

namespace RashidLaasri\YCODE\Resources;

use RashidLaasri\YCODE\DataObjects\Collection;
use RashidLaasri\YCODE\Requests\GetCollectionRequest;
use RashidLaasri\YCODE\Requests\ListCollectionsRequest;
use Saloon\Http\BaseResource;

final class CollectionResource extends BaseResource
{
    /**
     * @return Collection[]
     */
    public function list(): array
    {
        /** @var Collection[] $response */
        $response = $this->connector->send(new ListCollectionsRequest)->dto();

        return $response;
    }

    public function get(string $id): Collection
    {
        /** @var Collection $response */
        $response = $this->connector->send(new GetCollectionRequest($id))->dto();

        return $response;
    }
}
