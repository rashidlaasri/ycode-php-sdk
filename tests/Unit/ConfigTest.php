<?php

declare(strict_types=1);

use RashidLaasri\YCODE\Config;

it('creates a new config instance', function (): void {
    $config = new Config(
        baseUrl: 'https://app.ycode.com/api/v1',
        token: '<auth-token>',
    );

    expect($config->getBaseUrl())->toBe('https://app.ycode.com/api/v1');
    expect($config->getToken())->toBe('<auth-token>');
});
