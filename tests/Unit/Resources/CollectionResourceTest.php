<?php

declare(strict_types=1);

use RashidLaasri\YCODE\Requests\GetCollectionRequest;
use RashidLaasri\YCODE\Requests\ListCollectionsRequest;
use RashidLaasri\YCODE\Resources\CollectionResource;
use RashidLaasri\YCODE\YCode;
use Saloon\Http\Response;

it('send a list all collections request', function (): void {
    $mockConnector = Mockery::mock(YCode::class);
    $mockResponse = Mockery::mock(Response::class);

    $mockConnector
        ->shouldReceive('send')
        ->once()
        ->with(Mockery::type(ListCollectionsRequest::class))
        ->andReturn($mockResponse);

    (new CollectionResource($mockConnector))->list();
});

it('send a get collection request', function (): void {
    $mockConnector = Mockery::mock(YCode::class);
    $mockResponse = Mockery::mock(Response::class);

    $mockConnector
        ->shouldReceive('send')
        ->once()
        ->with(Mockery::on(fn($request): bool => $request instanceof GetCollectionRequest
            && $request->resolveEndpoint() === '/collections/637781341a6f7'))
        ->andReturn($mockResponse);

    (new CollectionResource($mockConnector))->get('637781341a6f7');
});
