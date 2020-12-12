<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/api' => [
            [['_route' => 'index', '_controller' => 'App\\Controller\\AnimesController::GetAll'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'store', '_controller' => 'App\\Controller\\AnimesController::Store'], null, ['POST' => 0], null, false, false, null],
        ],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/api/([^/]++)(*:55)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        55 => [
            [['_route' => 'delete', '_controller' => 'App\\Controller\\AnimesController::Delete'], ['id'], ['DELETE' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
