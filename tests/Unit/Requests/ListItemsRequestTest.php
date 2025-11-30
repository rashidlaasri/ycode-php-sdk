<?php

declare(strict_types=1);

use RashidLaasri\YCODE\DataObjects\Item;
use RashidLaasri\YCODE\Requests\ListItemsRequest;
use Saloon\Http\Response;

it('is a saloon request')
    ->expect(ListItemsRequest::class)
    ->toBeSaloonRequest()
    ->toSendGetRequest()
    ->toUseTimeoutTrait();

it('uses the correct endpoint', function (): void {
    $request = new ListItemsRequest('637781341a6f7', []);

    expect($request->resolveEndpoint())
        ->toBe('/collections/637781341a6f7/items');
});

it('returns items array', function (): void {
    $mockResponse = Mockery::mock(Response::class);
    $request = new ListItemsRequest('16687860798456377a79fce481', [
        'include' => 'Author, Categories',
        'filter' => [
            'name' => 'Blog',
        ],
    ]);

    $mockResponse
        ->shouldReceive('json')
        ->once()
        ->with('data')
        ->andReturn(get_fixture('list_items.json'));

    $response = $request->createDtoFromResponse($mockResponse);

    expect($request->query()->all())
        ->toBe([
            'include' => 'Author, Categories',
            'filter' => [
                'name' => 'Blog',
            ],
        ]);

    expect($response)
        ->toBeArray()
        ->toHavecount(1)
        ->each->toBeInstanceOf(Item::class);
});
