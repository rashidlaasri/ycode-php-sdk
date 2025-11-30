<?php

declare(strict_types=1);

namespace RashidLaasri\YCODE;

final readonly class Config
{
    public function __construct(
        private string $baseUrl,
        private string $token
    ) {
        //
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
