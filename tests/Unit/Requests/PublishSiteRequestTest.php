<?php

declare(strict_types=1);

use RashidLaasri\YCODE\DataObjects\Domain;
use RashidLaasri\YCODE\Requests\PublishSiteRequest;
use Saloon\Http\Response;

it('is a saloon request')
    ->expect(PublishSiteRequest::class)
    ->toBeSaloonRequest()
    ->toSendPostRequest()
    ->toUseTimeoutTrait();

it('uses the correct endpoint', function (): void {
    $request = new PublishSiteRequest;

    expect($request->resolveEndpoint())
        ->toBe('/publish');
});

it('returns a list of collections', function (): void {
    $request = new PublishSiteRequest('637781341a6f7');
    $mockResponse = Mockery::mock(Response::class);

    $mockResponse
        ->shouldReceive('json')
        ->once()
        ->andReturn(get_fixture('publish_site.json'));

    $response = $request->createDtoFromResponse($mockResponse);

    expect($response)->toBeArray()
        ->and($response)->each->toBeInstanceOf(Domain::class)
        ->and($response[0]->name)->toBe('example.ycode.site');
});
