<?php

declare(strict_types=1);

namespace RashidLaasri\YCODE;

use RashidLaasri\YCODE\Exceptions\YCodeException;
use RashidLaasri\YCODE\Pagination\PagedPagination;
use RashidLaasri\YCODE\Resources\CollectionResource;
use RashidLaasri\YCODE\Resources\ItemResource;
use RashidLaasri\YCODE\Resources\SiteResource;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\HasPagination;
use Saloon\PaginationPlugin\PagedPaginator;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;
use Throwable;

class YCode extends Connector implements HasPagination
{
    use AlwaysThrowOnErrors;

    public function __construct(private readonly Config $configs) {}

    public function resolveBaseUrl(): string
    {
        return $this->configs->getBaseUrl();
    }

    public function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    protected function defaultAuth(): TokenAuthenticator
    {
        return new TokenAuthenticator($this->configs->getToken());
    }

    public function paginate(Request $request): PagedPaginator
    {
        return new PagedPagination($this, $request);
    }

    public function getRequestException(Response $response, ?Throwable $senderException): YCodeException
    {
        return new YCodeException(
            $senderException?->getMessage() ?? 'Unknown error.',
            $senderException?->getCode() ?? 0,
        );
    }

    public function collections(): CollectionResource
    {
        return new CollectionResource($this);
    }

    public function items(): ItemResource
    {
        return new ItemResource($this);
    }

    public function sites(): SiteResource
    {
        return new SiteResource($this);
    }
}
