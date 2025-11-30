<?php

declare(strict_types=1);

namespace RashidLaasri\YCODE\Pagination;

use RashidLaasri\YCODE\DataObjects\Item;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\PagedPaginator;

final class PagedPagination extends PagedPaginator
{
    public function isLastPage(Response $response): bool
    {
        return is_null($response->json('next_page_url'));
    }

    /**
     * @return Item[]
     */
    public function getPageItems(Response $response, Request $request): array
    {
        /** @var Item[] $items */
        $items = $response->dto();

        return $items;
    }
}
