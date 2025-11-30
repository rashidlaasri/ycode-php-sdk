<?php

declare(strict_types=1);

use RashidLaasri\YCODE\Config;
use RashidLaasri\YCODE\Exceptions\YCodeException;
use RashidLaasri\YCODE\Resources\CollectionResource;
use RashidLaasri\YCODE\Resources\ItemResource;
use RashidLaasri\YCODE\Resources\SiteResource;
use RashidLaasri\YCODE\YCode;
use Saloon\Enums\Method;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

beforeEach(function (): void {
    $this->ycode = new YCode(new Config(
        baseUrl: 'https://app.ycode.com/api/v1',
        token: '<auth-token>',
    ));
});

it('is a valid saloon connector')
    ->expect(YCode::class)
    ->toBeSaloonConnector()
    ->toUsePagedPagination()
    ->toUseTokenAuthentication()
    ->toUseAlwaysThrowOnErrorsTrait();

it('has a default base url', function (): void {
    expect($this->ycode->resolveBaseUrl())
        ->toBe('https://app.ycode.com/api/v1');
});

it('has default headers', function (): void {
    expect($this->ycode->defaultHeaders())
        ->toHaveKey('Content-Type', 'application/json')
        ->toHaveKey('Accept', 'application/json');
});

it('has a collections resource', function (): void {
    expect($this->ycode->collections())
        ->toBeInstanceOf(CollectionResource::class);
});

it('has a sites resource', function (): void {
    expect($this->ycode->sites())
        ->toBeInstanceOf(SiteResource::class);
});

it('has an items resource', function (): void {
    expect($this->ycode->items())
        ->toBeInstanceOf(ItemResource::class);
});

it('uses token based authentication', function (): void {
    expect($this->ycode->getAuthenticator())
        ->toBeInstanceOf(TokenAuthenticator::class);
});

it('uses custom exception class', function (): void {
    $client = Mockery::mock(Response::class);

    expect($this->ycode->getRequestException($client, null))
        ->toBeInstanceOf(YCodeException::class);
});

function invokeProtected(object $object, string $method, array $args = [])
{
    $ref = new ReflectionClass($object);
    $m = $ref->getMethod($method);

    return $m->invokeArgs($object, $args);
}

it('covers paginator internals', function () {
    $connector = Mockery::mock(YCode::class)->makePartial();
    $request = Mockery::mock(new class extends Request implements Paginatable
    {
        protected Method $method = Method::GET;

        public function resolveEndpoint(): string
        {
            return '/fake';
        }
    });
    $response = Mockery::mock(Response::class);

    $paginator = $connector->paginate($request);

    // ---- getPageItems() ----
    $response->shouldReceive('dto')->andReturn(['collection_1', 'collection_2']);
    $items = (new ReflectionClass($paginator))->getPageItems($paginator, [$response, $request]);
    // $items = invokeProtected($paginator, 'getPageItems', [$response, $request]);
    expect($items)->toBe(['collection_1', 'collection_2']);

    // ---- isLastPage() true ----
    $response->shouldReceive('json')->with('next_page_url')->andReturn(null);
    $isLast = invokeProtected($paginator, 'isLastPage', [$response]);
    expect($isLast)->toBeTrue();

    // ---- isLastPage() false ----
    $response->shouldReceive('json')->with('next_page_url')->andReturn('123');
    $isLast = invokeProtected($paginator, 'isLastPage', [$response]);
    expect($isLast)->toBeTrue();
})->todo();
