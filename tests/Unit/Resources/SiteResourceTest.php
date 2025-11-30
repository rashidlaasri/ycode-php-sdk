<?php

declare(strict_types=1);

use RashidLaasri\YCODE\Requests\PublishSiteRequest;
use RashidLaasri\YCODE\Resources\SiteResource;
use RashidLaasri\YCODE\YCode;
use Saloon\Http\Response;

it('send a publish site request', function (): void {
    $mockConnector = Mockery::mock(YCode::class);
    $mockResponse = Mockery::mock(Response::class);

    $mockConnector
        ->shouldReceive('send')
        ->once()
        ->with(Mockery::type(PublishSiteRequest::class))
        ->andReturn($mockResponse);

    (new SiteResource($mockConnector))->publish();
});
