<?php

use App\Models\Setting;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

function defaultSetting()
{
    return Setting::select('*')->first();
}

function sidebarlist()
{
    $data = [];

    $data['modules'] = [
        [
            'module' => 'Years',
            'actions' => ['index', 'create', 'store', 'edit', 'update', 'delete'],
            'is_active' => true
        ],
        [
            'module' => 'Settings',
            'actions' => ['index', 'edit', 'update'],
            'is_active' => true
        ],
        [
            'module' => 'Roles',
            'actions' => ['index', 'create', 'store', 'edit', 'update', 'delete'],
            'is_active' => true
        ],

        [
            'module' => 'Users',
            'actions' => ['index', 'create', 'store', 'view', 'edit', 'update', 'delete', 'restore-password'],
            'is_active' => true
        ],
        [
            'module' => 'Role Permissions',
            'actions' => ['index', 'create', 'store', 'view', 'edit', 'update', 'delete'],
            'is_active' => true
        ],
        [
            'module' => 'User Permissions',
            'actions' => ['index', 'create', 'store', 'view', 'edit', 'update', 'delete'],
            'is_active' => false
        ],
        [
            'module' => 'Profile',
            'actions' => ['index', 'edit', 'update'],
            'is_active' => true
        ],
        [
            'module' => 'Departments',
            'actions' => ['index', 'create', 'store', 'view', 'edit', 'update', 'delete'],
            'is_active' => true
        ],
        [
            'module' => 'Designations',
            'actions' => ['index', 'create', 'store', 'view', 'edit', 'update', 'delete'],
            'is_active' => true
        ],
        [
            'module' => 'Officials',
            'actions' => ['index', 'create', 'store', 'view', 'edit', 'update', 'delete'],
            'is_active' => true
        ],
        [
            'module' => 'Document Types',
            'actions' => ['index', 'create', 'store', 'view', 'edit', 'update', 'delete'],
            'is_active' => true
        ],
        [
            'module' => 'Documents',
            'actions' => ['index', 'create', 'store', 'view', 'edit', 'update', 'delete'],
            'is_active' => true
        ],
        [
            'module' => 'Post Categories',
            'actions' => ['index', 'create', 'store', 'view', 'edit', 'update', 'delete'],
            'is_active' => true
        ],
        [
            'module' => 'Posts',
            'actions' => ['index', 'create', 'store', 'view', 'edit', 'update', 'delete'],
            'is_active' => true
        ],
        [
            'module' => 'Events',
            'actions' => ['index', 'create', 'store', 'view', 'edit', 'update', 'delete'],
            'is_active' => false
        ],
        [
            'module' => 'Pages',
            'actions' => ['index', 'create', 'store', 'view', 'edit', 'update', 'delete'],
            'is_active' => true
        ],
        [
            'module' => 'Facilities',
            'actions' => ['index', 'create', 'store', 'view', 'edit', 'update', 'delete'],
            'is_active' => true
        ],
        [
            'module' => 'Visitor Queries',
            'actions' => ['index', 'view', 'delete'],
            'is_active' => true
        ],
        [
            'module' => 'Banners',
            'actions' => ['index', 'create', 'store', 'view', 'edit', 'update', 'delete'],
            'is_active' => true
        ],
        [
            'module' => 'Galleries',
            'actions' => ['index', 'create', 'store', 'view', 'edit', 'update', 'delete'],
            'is_active' => true
        ],
        [
            'module' => 'Training Categories',
            'actions' => ['index', 'create', 'store', 'view', 'edit', 'update', 'delete'],
            'is_active' => false
        ],
        [
            'module' => 'Training Types',
            'actions' => ['index', 'create', 'store', 'view', 'edit', 'update', 'delete'],
            'is_active' => false
        ],
        [
            'module' => 'Trainings',
            'actions' => ['index', 'create', 'store', 'view', 'edit', 'update', 'delete'],
            'is_active' => false
        ],
        [
            'module' => 'Programs',
            'actions' => ['index', 'create', 'store', 'view', 'edit', 'update', 'delete'],
            'is_active' => true
        ],
        [
            'module' => 'Modules',
            'actions' => ['index'],
            'is_active' => false
        ],
        [
            'module' => 'Testimonials',
            'actions' => ['index', 'create', 'store', 'view', 'edit', 'update', 'delete'],
            'is_active' => true
        ],
        [
            'module' => 'Quick Links',
            'actions' => ['index', 'create', 'store', 'view', 'edit', 'update', 'delete'],
            'is_active' => true
        ],
        [
            'module' => 'Embeddings',
            'actions' => ['index', 'create', 'store', 'view', 'edit', 'update', 'delete'],
            'is_active' => true
        ]
    ];
    return $data;
}


function embeddingType($key)
{
    $types =  [
        'facebook-page' => 'Facebook Page',
        'twitter-handle' => 'Twitter Handle',
        'google-map' => 'Google Map',
    ];

    foreach ($types as $k => $value) {
        if ($k == $key) {
            return $types[$key];
        }
    }
}

function checkAccess($permission)
{
    if (is_string($permission)) {
        return Sentinel::hasAccess($permission);
    }

    if (is_array($permission)) {
        return Sentinel::hasAnyAccess($permission);
    }

    return false;
}

function getResourceFromRouteName($routeName)
{
    if (empty($routeName)) return '';
    $routeArray = explode('.', $routeName);
    return isset($routeArray[0]) ? $routeArray[0] : '';
}

function getResourceFromRouteUrl($routeUrl)
{
    // Parse URL properly regardless of environment
    $path = trim(parse_url($routeUrl, PHP_URL_PATH), '/');
    $segments = array_values(array_filter(explode('/', $path)));

    // Find 'admin' segment and return the next one
    $adminIndex = array_search('admin', $segments);
    if ($adminIndex !== false && isset($segments[$adminIndex + 1])) {
        return $segments[$adminIndex + 1];
    }

    // Fallback: return last segment
    return end($segments) ?: '';
}

function checkIsMenuActive($menuUrl)
{
    // Primary: use route name — works on all environments
    $currentRouteName = request()->route()?->getName() ?? '';

    if (!empty($currentRouteName)) {
        $currentResource = getResourceFromRouteName($currentRouteName);
    } else {
        // Fallback: parse URL if no route name available
        $currentResource = getResourceFromRouteUrl(url()->current());
    }

    if (empty($currentResource)) return false;

    if (is_string($menuUrl)) {
        $menuResource = getResourceFromRouteName($menuUrl);
        return $currentResource === $menuResource;
    }

    if (is_array($menuUrl)) {
        foreach ($menuUrl as $child) {
            if (!isset($child['route_name'])) continue;
            $childResource = getResourceFromRouteName($child['route_name']);
            if ($currentResource === $childResource) {
                return true;
            }
        }
        return false;
    }

    return false;
}
