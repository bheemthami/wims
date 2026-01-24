<?php

use App\Models\Setting;


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
