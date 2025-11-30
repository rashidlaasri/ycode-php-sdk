<?php

declare(strict_types=1);

use RashidLaasri\YCODE\DataObjects\Field;

it('creates a new field instance', function (): void {
    $field = new Field(
        id: 1,
        name: 'ID',
        type: 'number',
        default_value: null,
    );

    expect($field->id)->toBe(1);
    expect($field->name)->toBe('ID');
    expect($field->type)->toBe('number');
    expect($field->default_value)->toBeNull();
});

it('creates a new field instance from array', function (): void {
    $field = Field::fromResponse([
        'id' => 1,
        'name' => 'ID',
        'type' => 'number',
        'default' => null,
    ]);

    expect($field->id)->toBe(1);
    expect($field->name)->toBe('ID');
    expect($field->type)->toBe('number');
    expect($field->default_value)->toBeNull();
});
