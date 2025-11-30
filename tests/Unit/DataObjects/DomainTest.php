<?php

declare(strict_types=1);

use RashidLaasri\YCODE\DataObjects\Domain;

it('creates a new domain instance', function (): void {
    $domain = new Domain(
        name: 'example.ycode.site',
    );

    expect($domain->name)->toBe('example.ycode.site');
});
