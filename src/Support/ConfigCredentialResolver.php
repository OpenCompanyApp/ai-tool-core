<?php

namespace OpenCompany\IntegrationCore\Support;

use OpenCompany\IntegrationCore\Contracts\CredentialResolver;

/**
 * Default credential resolver that reads from Laravel config.
 *
 * Config structure: config/ai-tools.php
 *   'plausible' => ['api_key' => env('PLAUSIBLE_API_KEY'), 'url' => '...']
 */
class ConfigCredentialResolver implements CredentialResolver
{
    public function get(string $integration, string $key, mixed $default = null): mixed
    {
        return config("ai-tools.{$integration}.{$key}", $default);
    }

    public function isConfigured(string $integration): bool
    {
        return ! empty($this->get($integration, 'api_key'));
    }
}
