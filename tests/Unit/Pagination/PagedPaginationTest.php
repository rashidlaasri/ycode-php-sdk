<?php

use RashidLaasri\YCODE\Pagination\PagedPagination;
use Saloon\Http\Connector;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

beforeEach(function (): void {
    $this->connector = Mockery::mock(Connector::class);

    $this->request = Mockery::mock(new class extends Request implements Paginatable
    {
        public function resolveEndpoint(): string
        {
            return '/fake';
        }
    });
});

it('detects last page when next_page_url is null', function (): void {
    $response = Mockery::mock(Response::class);

    $response->shouldReceive('json')
        ->once()
        ->with('next_page_url')
        ->andReturn(null);

    $paginator = new PagedPagination($this->connector, $this->request);

    expect($paginator->isLastPage($response))->toBeTrue();
});

it('detects NOT last page when next_page_url is present', function (): void {
    $response = Mockery::mock(Response::class);

    $response->shouldReceive('json')
        ->once()
        ->with('next_page_url')
        ->andReturn('https://example.com/?page=2');

    $paginator = new PagedPagination($this->connector, $this->request);

    expect($paginator->isLastPage($response))->toBeFalse();
});

it('returns dto items from response', function (): void {
    $response = Mockery::mock(Response::class);
    $request = Mockery::mock(Request::class);

    $items = [
        ['_ycode_id' => '637781341a6f7'],
        ['_ycode_id' => '1668786079845'],
    ];

    $response->shouldReceive('dto')
        ->once()
        ->andReturn($items);

    $paginator = new PagedPagination($this->connector, $this->request);

    expect($paginator->getPageItems($response, $request))->toBe($items);
});
