<?php

namespace OpenCompany\IntegrationCore\Contracts;

use Laravel\Ai\Contracts\Tool;

interface ToolProvider
{
    /**
     * The app/group identifier (e.g., 'celestial', 'plausible').
     */
    public function appName(): string;

    /**
     * App group metadata for system prompt catalog and UI.
     *
     * Expected keys:
     *   'label'       => string  (e.g., 'moon, sun, planets, sky')
     *   'description' => string  (e.g., 'Astronomical calculations')
     *   'icon'        => string  (e.g., 'ph:moon-stars')
     *   'logo'        => string  (optional, brand logo icon)
     *
     * @return array{label: string, description: string, icon: string, logo?: string}
     */
    public function appMeta(): array;

    /**
     * Tool definitions with metadata.
     *
     * Returns slug => metadata array:
     *   'class'       => string  (FQCN of the Tool class)
     *   'type'        => string  ('read' or 'write')
     *   'name'        => string  (human-readable name)
     *   'description' => string  (short description)
     *   'icon'        => string  (Iconify icon identifier)
     *
     * @return array<string, array{class: string, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array;

    /**
     * Whether this is an external integration that can be toggled per agent.
     */
    public function isIntegration(): bool;

    /**
     * Create a tool instance.
     *
     * The $context array allows the host application to pass runtime
     * dependencies without coupling the core to specific models.
     * Inside OpenCompany: ['agent' => User, 'timezone' => string]
     * Standalone: [] or custom context
     */
    public function createTool(string $class, array $context = []): Tool;
}
