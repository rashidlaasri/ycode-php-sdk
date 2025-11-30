<?php

declare(strict_types=1);

namespace RashidLaasri\YCODE\DataObjects;

final readonly class Domain
{
    public function __construct(
        public string $name,
    ) {}
}
