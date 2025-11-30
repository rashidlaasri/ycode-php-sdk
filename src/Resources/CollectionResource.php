<?php

declare(strict_types=1);

namespace RashidLaasri\YCODE\Resources;

use RashidLaasri\YCODE\DataObjects\Collection;
use RashidLaasri\YCODE\Requests\GetCollectionRequest;
use RashidLaasri\YCODE\Requests\ListCollectionsRequest;
use Saloon\Http\BaseResource;

final class CollectionResource extends BaseResource
{
    public function list(): array
    {
        return $this->connector->send(new ListCollectionsRequest)->dto();
    }

    public function get(string $id): Collection
    {
        return $this->connector->send(new GetCollectionRequest($id))->dto();
    }
}
