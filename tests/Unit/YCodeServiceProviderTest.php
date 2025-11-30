<?php

use RashidLaasri\YCODE\YCode;
use RashidLaasri\YCODE\YCodeServiceProvider;

it('binds YCode class to the container', function (): void {
    app('config')->set([
        'ycode.base_url' => 'https://api.example.com',
        'ycode.token' => '<access-token>',
    ]);

    app()->register(YCodeServiceProvider::class);

    expect(app(YCode::class))->toBeInstanceOf(YCode::class);
});
