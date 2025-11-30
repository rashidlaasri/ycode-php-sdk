<?php

declare(strict_types=1);

use Tests\TestCase;

pest()->use(TestCase::class);

function get_fixture(string $path): array
{
    return json_decode(file_get_contents(fixture($path)), true);
}
