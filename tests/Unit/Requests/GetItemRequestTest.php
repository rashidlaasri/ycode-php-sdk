<?php

declare(strict_types=1);

use RashidLaasri\YCODE\DataObjects\Item;
use RashidLaasri\YCODE\Requests\GetItemRequest;
use Saloon\Http\Response;

it('is a saloon request')
    ->expect(GetItemRequest::class)
    ->toBeSaloonRequest()
    ->toSendGetRequest()
    ->toUseTimeoutTrait();

it('uses the correct endpoint', function (): void {
    $request = new GetItemRequest('637781341a6f7', '123');

    expect($request->resolveEndpoint())
        ->toBe('/collections/637781341a6f7/items/123');
});

it('returns item dto', function (): void {
    $request = new GetItemRequest('16687860798456377a79fce481', '123');
    $mockResponse = Mockery::mock(Response::class);

    $mockResponse
        ->shouldReceive('json')
        ->once()
        ->with('data')
        ->andReturn(get_fixture('get_item.json'));

    $response = $request->createDtoFromResponse($mockResponse);

    expect($response)->toBeInstanceOf(Item::class);
});
