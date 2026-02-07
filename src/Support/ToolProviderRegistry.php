<?php

namespace OpenCompany\IntegrationCore\Support;

use OpenCompany\IntegrationCore\Contracts\ToolProvider;

class ToolProviderRegistry
{
    /** @var array<string, ToolProvider> */
    private array $providers = [];

    public function register(ToolProvider $provider): void
    {
        $this->providers[$provider->appName()] = $provider;
    }

    /** @return array<string, ToolProvider> */
    public function all(): array
    {
        return $this->providers;
    }

    public function get(string $appName): ?ToolProvider
    {
        return $this->providers[$appName] ?? null;
    }

    public function has(string $appName): bool
    {
        return isset($this->providers[$appName]);
    }
}
