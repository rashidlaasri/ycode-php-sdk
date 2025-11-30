<?php

declare(strict_types=1);

namespace RashidLaasri\YCODE\Resources;

use RashidLaasri\YCODE\Requests\ListItemsRequest;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

final class ItemResource extends BaseResource
{
    public function list(string $collectionId): Response
    {
        return $this->connector->send(new ListItemsRequest($collectionId));
    }
}
