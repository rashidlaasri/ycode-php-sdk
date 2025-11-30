<?php

declare(strict_types=1);

namespace RashidLaasri\YCODE\Resources;

use RashidLaasri\YCODE\DataObjects\Domain;
use RashidLaasri\YCODE\Requests\PublishSiteRequest;
use Saloon\Http\BaseResource;

final class SiteResource extends BaseResource
{
    /**
     * Publishes site to all domains.
     *
     * @return Domain[]
     */
    public function publish(): array
    {
        /** @var Domain[] $domains */
        $domains = $this->connector->send(new PublishSiteRequest)->dto();

        return $domains;
    }
}
