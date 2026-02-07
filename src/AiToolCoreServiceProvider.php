<?php

namespace OpenCompany\AiToolCore;

use Illuminate\Support\ServiceProvider;
use OpenCompany\AiToolCore\Contracts\CredentialResolver;
use OpenCompany\AiToolCore\Support\ConfigCredentialResolver;
use OpenCompany\AiToolCore\Support\ToolProviderRegistry;

class AiToolCoreServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ToolProviderRegistry::class);

        // Default credential resolver; host apps can override with their own
        $this->app->bindIf(CredentialResolver::class, ConfigCredentialResolver::class);
    }
}
