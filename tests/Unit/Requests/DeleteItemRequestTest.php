<?php

declare(strict_types=1);

use RashidLaasri\YCODE\Requests\DeleteItemRequest;
use Saloon\Http\Response;

it('is a saloon request')
    ->expect(DeleteItemRequest::class)
    ->toBeSaloonRequest()
    ->toSendDeleteRequest()
    ->toHaveJsonBody()
    ->toUseTimeoutTrait();

it('uses the correct endpoint', function (): void {
    $request = new DeleteItemRequest('637781341a6f7', 'abc123', []);

    expect($request->resolveEndpoint())
        ->toBe('/collections/637781341a6f7/items/abc123');
});

it('sends correct request', function (): void {
    $mockResponse = Mockery::mock(Response::class);
    $request = new DeleteItemRequest('16687860798456377a79fce481', 'abc123', [
        '_draft' => true,
    ]);

    $mockResponse
        ->shouldReceive('json')
        ->once()
        ->with('data')
        ->andReturn([]);

    $response = $request->createDtoFromResponse($mockResponse);

    expect($request->body()->all())
        ->toBe([
            '_draft' => true,
        ]);

    expect($response)->toBeArray();
});
