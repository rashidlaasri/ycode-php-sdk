<?php

declare(strict_types=1);

namespace RashidLaasri\YCODE\Resources;

use RashidLaasri\YCODE\Requests\PublishSiteRequest;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

final class SiteResource extends BaseResource
{
    public function publish(): array
    {
        return $this->connector->send(new PublishSiteRequest)->dto();
    }
}
