<?php

declare(strict_types=1);

namespace RashidLaasri\YCODE\Resources;

use RashidLaasri\YCODE\Requests\ListItemsRequest;
use Saloon\Http\BaseResource;

final class ItemResource extends BaseResource
{
    public function list(string $collectionId): array
    {
        return $this->connector->send(new ListItemsRequest($collectionId))->dto();
    }
}
