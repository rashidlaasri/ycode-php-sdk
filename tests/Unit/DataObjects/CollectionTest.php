<?php

declare(strict_types=1);

use Carbon\Carbon;
use RashidLaasri\YCODE\DataObjects\Collection;

it('creates a new collection instance', function (): void {
    $collection = new Collection(
        _ycode_id: '637781341a6f7',
        name: 'Blogposts',
        singular_name: 'Blogpost',
        created_at: Carbon::parse('2022-11-18T12:57:24.000Z'),
    );

    expect($collection->_ycode_id)->toBe('637781341a6f7');
    expect($collection->name)->toBe('Blogposts');
    expect($collection->singular_name)->toBe('Blogpost');
    expect($collection->created_at)->toBeInstanceOf(Carbon::class);
    expect($collection->created_at->toDateTimeString())->toBe('2022-11-18 12:57:24');
    expect($collection->fields)->toBe([]);
});
