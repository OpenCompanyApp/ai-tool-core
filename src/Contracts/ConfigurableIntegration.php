<?php

namespace OpenCompany\IntegrationCore\Contracts;

interface ConfigurableIntegration
{
    /**
     * Integration metadata for the UI.
     *
     * Used to render integration cards and config modals without
     * hardcoding anything in the host application.
     *
     * @return array{
     *     name: string,
     *     description: string,
     *     icon: string,
     *     logo?: string,
     *     category: string,
     *     badge?: string,
     *     docs_url?: string,
     * }
     */
    public function integrationMeta(): array;

    /**
     * Configuration field schema for dynamic form rendering.
     *
     * Returns an ordered array of field definitions. Each field:
     *
     *   'key'              => string   Config storage key (e.g., 'api_key')
     *   'type'             => string   'secret' | 'url' | 'text' | 'select' | 'string_list' | 'oauth_connect'
     *   'label'            => string   Display label
     *   'placeholder'      => string   Input placeholder (optional)
     *   'hint'             => string   Help text below the field, supports inline HTML (optional)
     *   'required'         => bool     Whether field is required for saving (optional, default false)
     *   'default'          => mixed    Default value (optional)
     *   'options'          => array    For 'select' type: ['value' => 'Label', ...] (optional)
     *   'item_icon'        => string   For 'string_list': icon for each list item (optional)
     *   'item_placeholder' => string   For 'string_list': placeholder for the add input (optional)
     *   'authorize_url'    => string   For 'oauth_connect': path to OAuth authorize endpoint (optional)
     *   'redirect_uri'     => string   For 'oauth_connect': callback path shown as hint to user (optional)
     *   'visible_when'     => array    Conditionally show field: ['field' => 'other_key', 'value' => 'match'] (optional)
     *                                  Value can be a string or array of strings for multi-match.
     *
     * @return array<int, array{key: string, type: string, label: string}>
     */
    public function configSchema(): array;

    /**
     * Test the connection with the given config values.
     *
     * Receives raw form values (not yet saved). Secret fields may be
     * masked (contain '*') if unchanged — the host app substitutes
     * stored values before calling this method.
     *
     * @param  array<string, mixed> $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array;

    /**
     * Laravel validation rules for saving config.
     *
     * Keys correspond to configSchema field keys.
     *
     * @return array<string, string|array>
     */
    public function validationRules(): array;
}
