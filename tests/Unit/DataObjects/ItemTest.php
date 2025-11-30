<?php

declare(strict_types=1);

use Carbon\Carbon;
use RashidLaasri\YCODE\DataObjects\Category;
use RashidLaasri\YCODE\DataObjects\Item;

it('creates a new item instance', function (): void {
    $item = new Item(
        _ycode_id: '16687860798456377a79fce481',
        id: 1,
        name: 'Blogpost title',
        slug: 'blogpost-title',
        created_at: Carbon::parse('2022-11-18T15:41:19.000Z'),
        updated_at: Carbon::parse('2022-11-18T15:42:03.000Z'),
        created_by: '1669309481596637fa4299184e',
        updated_by: '1669309527456637fa4576f6dc',
        summary: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        main_image: 'https://example.com/main_image.png',
        thumbnail: 'https://example.com/thumbnail.png',
        featured: true,
        author: '16687859744696377a736727d8',
        categories: [
            new Category('1669309639520637fa4c77eea7'),
            new Category('1669309662211637fa4de338d6'),
        ],
        body: '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>',
    );

    expect($item)->toBeValidCollectionItem();
});

it('creates a new item instance from response', function (): void {
    $item = Item::fromResponse([
        '_ycode_id' => '16687860798456377a79fce481',
        'ID' => 1,
        'Name' => 'Blogpost title',
        'Slug' => 'blogpost-title',
        'Created date' => '2022-11-18T15:41:19.000Z',
        'Updated date' => '2022-11-18T15:42:03.000Z',
        'Created by' => '1669309481596637fa4299184e',
        'Updated by' => '1669309527456637fa4576f6dc',
        'Summary' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        'Main Image' => 'https://example.com/main_image.png',
        'Thumbnail Image' => 'https://example.com/thumbnail.png',
        'Featured' => 1,
        'Author' => '16687859744696377a736727d8',
        'Categories' => [
            '1669309639520637fa4c77eea7',
            '1669309662211637fa4de338d6',
        ],
        'Body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>',
    ]);

    expect($item)->toBeValidCollectionItem();
});

expect()->extend('toBeValidCollectionItem', function (): self {
    expect($this->value->_ycode_id)->toBe('16687860798456377a79fce481')
        ->and($this->value->id)->toBe(1)
        ->and($this->value->name)->toBe('Blogpost title')
        ->and($this->value->slug)->toBe('blogpost-title')
        ->and($this->value->created_at)->toBeInstanceOf(Carbon::class)
        ->and($this->value->created_at->toDateTimeString())->toBe('2022-11-18 15:41:19')
        ->and($this->value->updated_at)->toBeInstanceOf(Carbon::class)
        ->and($this->value->updated_at->toDateTimeString())->toBe('2022-11-18 15:42:03')
        ->and($this->value->created_by)->toBe('1669309481596637fa4299184e')
        ->and($this->value->updated_by)->toBe('1669309527456637fa4576f6dc')
        ->and($this->value->summary)->toBe('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
        ->and($this->value->main_image)->toBe('https://example.com/main_image.png')
        ->and($this->value->thumbnail)->toBe('https://example.com/thumbnail.png')
        ->and($this->value->featured)->toBeTrue()
        ->and($this->value->author)->toBe('16687859744696377a736727d8')
        ->and($this->value->body)->toBe('<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>')
        ->and($this->value->categories)->toBeArray()
        ->and($this->value->categories)->toHaveCount(2)
        ->and($this->value->categories)->each->toBeInstanceOf(Category::class)
        ->and($this->value->categories[0]->name)->toBe('1669309639520637fa4c77eea7');

    return $this;
});
