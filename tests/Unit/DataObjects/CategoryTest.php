<?php

declare(strict_types=1);

use RashidLaasri\YCODE\DataObjects\Category;

it('creates a new category instance', function (): void {
    $category = new Category(
        name: '1669309639520637fa4c77eea7',
    );

    expect($category->name)->toBe('1669309639520637fa4c77eea7');
});

it('creates a new category instance from response', function (): void {
    $category = Category::fromResponse('1669309639520637fa4c77eea7');

    expect($category->name)->toBe('1669309639520637fa4c77eea7');
});
