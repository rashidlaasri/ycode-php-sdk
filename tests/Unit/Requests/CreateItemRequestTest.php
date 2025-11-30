<?php

declare(strict_types=1);

use RashidLaasri\YCODE\DataObjects\Item;
use RashidLaasri\YCODE\Requests\CreateItemRequest;
use Saloon\Http\Response;

it('is a saloon request')
    ->expect(CreateItemRequest::class)
    ->toBeSaloonRequest()
    ->toSendPostRequest()
    ->toHaveJsonBody()
    ->toUseTimeoutTrait();

it('uses the correct endpoint', function (): void {
    $request = new CreateItemRequest('637781341a6f7', []);

    expect($request->resolveEndpoint())
        ->toBe('/collections/637781341a6f7/items');
});

it('sends correct request', function (): void {
    $mockResponse = Mockery::mock(Response::class);
    $request = new CreateItemRequest('16687860798456377a79fce481', [
        'name' => 'Blogpost title',
        'slug' => 'blogpost-title',
    ]);

    $mockResponse
        ->shouldReceive('json')
        ->once()
        ->with('data')
        ->andReturn(get_fixture('get_item.json'));

    $response = $request->createDtoFromResponse($mockResponse);

    expect($request->body()->all())
        ->toBe([
            'name' => 'Blogpost title',
            'slug' => 'blogpost-title',
        ]);

    expect($response)->toBeInstanceOf(Item::class);
});
