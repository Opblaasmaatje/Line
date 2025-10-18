<?php

return [
    'directories' => [
        base_path('app'.DIRECTORY_SEPARATOR.'Models'),
        base_path('app'.DIRECTORY_SEPARATOR.'Modules'.DIRECTORY_SEPARATOR.'Points'.DIRECTORY_SEPARATOR.'Models'),
        base_path('app'.DIRECTORY_SEPARATOR.'Modules'.DIRECTORY_SEPARATOR.'Pets'.DIRECTORY_SEPARATOR.'Models'),

    ],

    'ignore' => [],

    'whitelist' => [],

    'recursive' => true,

    'use_db_schema' => true,
    'use_column_types' => true,

    'table' => [
        'header_background_color' => '#2C2C3C',
        'header_font_color' => '#FFFFFF',
        'row_background_color' => '#1E1E2E',
        'row_font_color' => '#CCCCCC',
    ],

    'graph' => [
        'style' => 'filled',
        'bgcolor' => '#1E1E2E',
        'fontsize' => 12,
        'labelloc' => 't',
        'concentrate' => true,
        'splines' => 'spline',
        'overlap' => false,
        'nodesep' => 1.5,
        'rankdir' => 'LR',
        'pad' => 2.5,
        'ranksep' => 2,
        'esep' => true,
        'fontname' => 'Helvetica Neue',
        'fontcolor' => '#E0E0E0',
    ],

    'node' => [
        'margin' => 0.3,
        'shape' => 'rectangle',
        'style' => 'filled',
        'fillcolor' => '#2E2E3E',
        'fontcolor' => '#FFFFFF',
        'fontname' => 'Helvetica Neue',
        'color' => '#4A4A5A',
        'penwidth' => 2,
    ],

    'edge' => [
        'color' => '#BBBBBB',
        'penwidth' => 1.8,
        'fontcolor' => '#CCCCCC',
        'fontname' => 'Helvetica Neue',
    ],

    'relations' => [
        'HasOne' => [
            'dir' => 'both',
            'color' => '#EF476F',
            'arrowhead' => 'tee',
            'arrowtail' => 'none',
        ],
        'BelongsTo' => [
            'dir' => 'both',
            'color' => '#FFD166',
            'arrowhead' => 'tee',
            'arrowtail' => 'crow',
        ],
        'HasMany' => [
            'dir' => 'both',
            'color' => '#06D6A0',
            'arrowhead' => 'crow',
            'arrowtail' => 'none',
        ],
    ],
];
