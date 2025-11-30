<?php

declare(strict_types=1);

use RashidLaasri\YCODE\DataObjects\Item;
use RashidLaasri\YCODE\Requests\CreateItemRequest;
use RashidLaasri\YCODE\Requests\DeleteItemRequest;
use RashidLaasri\YCODE\Requests\GetItemRequest;
use RashidLaasri\YCODE\Requests\ListItemsRequest;
use RashidLaasri\YCODE\Requests\PatchItemRequest;
use RashidLaasri\YCODE\Requests\UpdateItemRequest;
use RashidLaasri\YCODE\Resources\ItemResource;
use RashidLaasri\YCODE\YCode;
use Saloon\Enums\Method;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\PagedPaginator;

it('sends list items request', function (): void {
    $mockConnector = Mockery::mock(YCode::class);
    $mockResponse = Mockery::mock(PagedPaginator::class);

    $mockConnector
        ->shouldReceive('paginate')
        ->once()
        ->with(Mockery::type(ListItemsRequest::class))
        ->andReturn($mockResponse);

    (new ItemResource($mockConnector))->list('16687860798456377a79fce481');
});

it('sends get item request', function (): void {
    $mockConnector = Mockery::mock(YCode::class);
    $mockResponse = Mockery::mock(Response::class);

    $mockConnector
        ->shouldReceive('send')
        ->once()
        ->with(Mockery::type(GetItemRequest::class))
        ->andReturn($mockResponse);

    $mockResponse
        ->shouldReceive('dto')
        ->once()
        ->andReturn((new ReflectionClass(Item::class))->newInstanceWithoutConstructor());

    (new ItemResource($mockConnector))->get('16687860798456377a79fce481', '123');
});

it('sends create item request', function (): void {
    $mockConnector = Mockery::mock(YCode::class);
    $mockResponse = Mockery::mock(Response::class);

    $mockConnector
        ->shouldReceive('send')
        ->once()
        ->with(Mockery::on(fn ($request): bool => $request instanceof CreateItemRequest
            && $request->getMethod() === Method::POST
            && $request->body()->all() === [
                'name' => 'Blogpost title #1',
            ]))
        ->andReturn($mockResponse);

    $mockResponse
        ->shouldReceive('dto')
        ->once()
        ->andReturn((new ReflectionClass(Item::class))->newInstanceWithoutConstructor());

    (new ItemResource($mockConnector))->create('16687860798456377a79fce481', [
        'name' => 'Blogpost title #1',
    ]);
});

it('sends update item request', function (): void {
    $mockConnector = Mockery::mock(YCode::class);
    $mockResponse = Mockery::mock(Response::class);

    $mockConnector
        ->shouldReceive('send')
        ->once()
        ->with(Mockery::on(fn ($request): bool => $request instanceof UpdateItemRequest
            && $request->getMethod() === Method::PUT
            && $request->body()->all() === [
                'name' => 'Blogpost title - updated',
            ]))
        ->andReturn($mockResponse);

    $mockResponse
        ->shouldReceive('dto')
        ->once()
        ->andReturn((new ReflectionClass(Item::class))->newInstanceWithoutConstructor());

    (new ItemResource($mockConnector))->update('16687860798456377a79fce481', '123', [
        'name' => 'Blogpost title - updated',
    ]);
});

it('sends patch item request', function (): void {
    $mockConnector = Mockery::mock(YCode::class);
    $mockResponse = Mockery::mock(Response::class);

    $mockConnector
        ->shouldReceive('send')
        ->once()
        ->with(Mockery::on(fn ($request): bool => $request instanceof PatchItemRequest
            && $request->getMethod() === Method::PATCH
            && $request->body()->all() === [
                'name' => 'Blogpost title - patched',
            ]))
        ->andReturn($mockResponse);

    $mockResponse
        ->shouldReceive('dto')
        ->once()
        ->andReturn((new ReflectionClass(Item::class))->newInstanceWithoutConstructor());

    (new ItemResource($mockConnector))->patch('16687860798456377a79fce481', '123', [
        'name' => 'Blogpost title - patched',
    ]);
});

it('sends delete item request', function (): void {
    $mockConnector = Mockery::mock(YCode::class);
    $mockResponse = Mockery::mock(Response::class);

    $mockConnector
        ->shouldReceive('send')
        ->once()
        ->with(Mockery::on(fn ($request): bool => $request instanceof DeleteItemRequest
            && $request->getMethod() === Method::DELETE
            && $request->body()->all() === [
                '_draft' => true,
            ]))
        ->andReturn($mockResponse);

    $mockResponse
        ->shouldReceive('dto')
        ->once()
        ->andReturn([]);

    (new ItemResource($mockConnector))->delete('16687860798456377a79fce481', '123', [
        '_draft' => true,
    ]);
});
