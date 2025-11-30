<?php

declare(strict_types=1);

namespace RashidLaasri\YCODE\Requests;

use RashidLaasri\YCODE\DataObjects\Domain;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Plugins\HasTimeout;

final class PublishSiteRequest extends Request
{
    use HasTimeout;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/publish';
    }

    /**
     * @return Domain[]
     */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var string[] $domains */
        $domains = $response->json('domains');

        return array_map(fn (string $domain): Domain => new Domain($domain), $domains);
    }
}
