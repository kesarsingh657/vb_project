<?php
/**
 * Plugin configuration.
 */

return [
    'DebugKit' => ['onlyDebug' => true],
    'Bake' => ['onlyCli' => true, 'optional' => true],

    // Removed Migrations to avoid duplicate loading
    // 'Migrations' => ['onlyCli' => true],

    // Additional plugins here
];
