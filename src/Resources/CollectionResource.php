<?php

declare(strict_types=1);

namespace RashidLaasri\YCODE\Resources;

use RashidLaasri\YCODE\Requests\GetCollectionRequest;
use RashidLaasri\YCODE\Requests\ListCollectionsRequest;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

final class CollectionResource extends BaseResource
{
    public function list(): Response
    {
        return $this->connector->send(new ListCollectionsRequest);
    }

    public function get(string $id): Response
    {
        return $this->connector->send(new GetCollectionRequest($id));
    }
}
