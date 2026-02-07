<?php

namespace OpenCompany\AiToolCore\Contracts;

interface CredentialResolver
{
    /**
     * Get a credential value for an integration.
     *
     * @param string $integration  The integration ID (e.g., 'plausible')
     * @param string $key          The config key (e.g., 'api_key', 'url')
     * @param mixed  $default      Default value if not found
     */
    public function get(string $integration, string $key, mixed $default = null): mixed;

    /**
     * Check whether the integration has valid credentials configured.
     */
    public function isConfigured(string $integration): bool;
}
