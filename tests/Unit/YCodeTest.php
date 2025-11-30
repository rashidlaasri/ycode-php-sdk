<?php

declare(strict_types=1);

use RashidLaasri\YCODE\Config;
use RashidLaasri\YCODE\Exceptions\YCodeException;
use RashidLaasri\YCODE\Resources\CollectionResource;
use RashidLaasri\YCODE\Resources\SiteResource;
use RashidLaasri\YCODE\YCode;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Response;

beforeEach(function (): void {
    $this->ycode = new YCode(new Config(
        baseUrl: 'https://app.ycode.com/api/v1',
        token: '<auth-token>',
    ));
});

it('is a valid saloon connector')
    ->expect(YCode::class)
    ->toBeSaloonConnector()
    ->toUseTokenAuthentication()
    ->toUseAlwaysThrowOnErrorsTrait();

it('has a default base url', function (): void {
    expect($this->ycode->resolveBaseUrl())
        ->toBe('https://app.ycode.com/api/v1');
});

it('has default headers', function (): void {
    expect($this->ycode->defaultHeaders())
        ->toHaveKey('Content-Type', 'application/json')
        ->toHaveKey('Accept', 'application/json');
});

it('has a collections resource', function (): void {
    expect($this->ycode->collections())
        ->toBeInstanceOf(CollectionResource::class);
});

it('has a sites resource', function (): void {
    expect($this->ycode->sites())
        ->toBeInstanceOf(SiteResource::class);
});

it('uses token based authentication', function (): void {
    expect($this->ycode->getAuthenticator())
        ->toBeInstanceOf(TokenAuthenticator::class);
});

it('uses custom exception class', function (): void {
    $client = Mockery::mock(Response::class);

    expect($this->ycode->getRequestException($client, null))
        ->toBeInstanceOf(YCodeException::class);
});
