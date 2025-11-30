<?php

declare(strict_types=1);

use Carbon\Carbon;
use RashidLaasri\YCODE\DataObjects\Collection;
use RashidLaasri\YCODE\Requests\GetCollectionRequest;
use Saloon\Http\Response;

it('is a saloon request')
    ->expect(GetCollectionRequest::class)
    ->toBeSaloonRequest()
    ->toSendGetRequest()
    ->toUseTimeoutTrait();

it('uses the correct endpoint', function (): void {
    $request = new GetCollectionRequest('637781341a6f7');

    expect($request->resolveEndpoint())
        ->toBe('/collections/637781341a6f7');
});

it('returns a collection dto', function (): void {
    $request = new GetCollectionRequest('637781341a6f7');
    $mockResponse = Mockery::mock(Response::class);

    $mockResponse
        ->shouldReceive('json')
        ->once()
        ->andReturn(get_fixture('get_collection.json'));

    $response = $request->createDtoFromResponse($mockResponse);

    expect($response)->toBeInstanceOf(Collection::class)
        ->and($response->_ycode_id)->toBe('637781341a6f7')
        ->and($response->name)->toBe('Blogposts')
        ->and($response->singular_name)->toBe('Blogpost')
        ->and($response->created_at)->toBeInstanceOf(Carbon::class)
        ->and($response->created_at->toDateTimeString())->toBe('2022-11-18 12:57:24');

    expect($response->fields)
        ->toBeArray()
        ->toHaveCount(14)
        ->and($response->fields)->each->toBeArray()
        ->and($response->fields[0]['id'])->toBe(1)
        ->and($response->fields[0]['name'])->toBe('ID')
        ->and($response->fields[0]['type'])->toBe('number')
        ->and($response->fields[0]['default'])->toBeNull();
});
