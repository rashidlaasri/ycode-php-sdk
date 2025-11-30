<?php

declare(strict_types=1);

use Carbon\Carbon;
use RashidLaasri\YCODE\DataObjects\Collection;
use RashidLaasri\YCODE\Requests\ListCollectionsRequest;
use Saloon\Http\Response;

it('is a saloon request')
    ->expect(ListCollectionsRequest::class)
    ->toBeSaloonRequest()
    ->toSendGetRequest()
    ->toUseTimeoutTrait();

it('uses the correct endpoint', function (): void {
    $request = new ListCollectionsRequest;

    expect($request->resolveEndpoint())
        ->toBe('/collections');
});

it('returns a list of collections', function (): void {
    $request = new ListCollectionsRequest('637781341a6f7');
    $mockResponse = Mockery::mock(Response::class);

    $mockResponse
        ->shouldReceive('json')
        ->once()
        ->with('data')
        ->andReturn(get_fixture('list_collections.json'));

    $response = $request->createDtoFromResponse($mockResponse);

    expect($response)->toBeArray()
        ->and($response)->each->toBeInstanceOf(Collection::class)
        ->and($response[0]->_ycode_id)->toBe('637781341a6f7')
        ->and($response[0]->name)->toBe('Blogposts')
        ->and($response[0]->singular_name)->toBe('Blogpost')
        ->and($response[0]->created_at)->toBeInstanceOf(Carbon::class)
        ->and($response[0]->created_at->toDateTimeString())->toBe('2022-11-18 12:57:24');
});
