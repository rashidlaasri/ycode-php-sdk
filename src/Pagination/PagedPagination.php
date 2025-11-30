<?php

declare(strict_types=1);

namespace RashidLaasri\YCODE\Pagination;

use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\PagedPaginator as SaloonPagedPaginator;

final class PagedPagination extends SaloonPagedPaginator
{
    public function isLastPage(Response $response): bool
    {
        return is_null($response->json('next_page_url'));
    }

    public function getPageItems(Response $response, Request $request): array
    {
        return $response->dto();
    }
}
