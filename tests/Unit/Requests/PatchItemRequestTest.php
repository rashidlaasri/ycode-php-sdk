<?php

declare(strict_types=1);

use RashidLaasri\YCODE\DataObjects\Item;
use RashidLaasri\YCODE\Requests\PatchItemRequest;
use Saloon\Http\Response;

it('is a saloon request')
    ->expect(PatchItemRequest::class)
    ->toBeSaloonRequest()
    ->toSendPatchRequest()
    ->toHaveJsonBody()
    ->toUseTimeoutTrait();

it('uses the correct endpoint', function (): void {
    $request = new PatchItemRequest('637781341a6f7', 'abc123', []);

    expect($request->resolveEndpoint())
        ->toBe('/collections/637781341a6f7/items/abc123');
});

it('sends correct request', function (): void {
    $mockResponse = Mockery::mock(Response::class);
    $request = new PatchItemRequest('16687860798456377a79fce481', 'abc123', [
        'name' => 'Blogpost title-patched',
    ]);

    $mockResponse
        ->shouldReceive('json')
        ->once()
        ->with('data')
        ->andReturn(get_fixture('get_item.json'));

    $response = $request->createDtoFromResponse($mockResponse);

    expect($request->body()->all())
        ->toBe([
            'name' => 'Blogpost title-patched',
        ]);

    expect($response)->toBeInstanceOf(Item::class);
});
