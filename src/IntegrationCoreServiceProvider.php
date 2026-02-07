<?php

namespace OpenCompany\IntegrationCore;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ConfigCredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class IntegrationCoreServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ToolProviderRegistry::class);

        // Default credential resolver; host apps can override with their own
        $this->app->bindIf(CredentialResolver::class, ConfigCredentialResolver::class);
    }
}
