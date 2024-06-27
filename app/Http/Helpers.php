<?php

use App\Models\Setting;


function defaultSetting(){
    return Setting::select('*')->first();

}

function sidebarlist()
{
    $data = [];
   
    $data['modules'] = [
        [ 
            'module' => 'Settings',
            'actions' => ['index','edit','update']
        ],[ 
            'module' => 'Academic Years',
            'actions' => ['index','create','store','view','edit','update','delete']
        ],[ 
            'module' => 'Users',
            'actions' => ['index','create','store','view','edit','update','delete','restore-password']
        ],[ 
            'module' => 'Profile',
            'actions' => ['index','edit','update']
        ],[ 
            'module' => 'Roles',
            'actions' => ['index','create','store','view','edit','update','delete']
        ],[ 
            'module' => 'Designations',
            'actions' => ['index','create','store','view','edit','update','delete']
        ],[ 
            'module' => 'Role Permissions',
            'actions' => ['index','create','store','view','edit','update','delete']
        ],[ 
            'module' => 'User Permissions',
            'actions' => ['index','create','store','view','edit','update','delete']
        ],[ 
            'module' => 'Pages',
            'actions' => ['index','create','store','view','edit','update','delete']
        ],[ 
            'module' => 'Visitor Queries',
            'actions' => ['index','create','store','view','edit','update','delete']
        ],[ 
            'module' => 'Post Categories',
            'actions' => ['index','create','store','view','edit','update','delete']
        ],[ 
            'module' => 'Posts',
            'actions' => ['index','create','store','view','edit','update','delete']
        ],[ 
            'module' => 'Events',
            'actions' => ['index','create','store','view','edit','update','delete']
        ],[ 
            'module' => 'Banners',
            'actions' => ['index','create','store','view','edit','update','delete']
        ],
        [ 
            'module' => 'Document Types',
            'actions' => ['index','create','store','view','edit','update','delete']
        ],[ 
            'module' => 'Documents',
            'actions' => ['index','create','store','view','edit','update','delete']
        ],[ 
            'module' => 'Galleries',
            'actions' => ['index','create','store','view','edit','update','delete']
        ],[ 
            'module' => 'Training Categories',
            'actions' => ['index','create','store','view','edit','update','delete']
        ],[ 
            'module' => 'Training Types',
            'actions' => ['index','create','store','view','edit','update','delete']
        ],[ 
            'module' => 'Trainings',
            'actions' => ['index','create','store','view','edit','update','delete']
        ],[ 
            'module' => 'Programs',
            'actions' => ['index','create','store','view','edit','update','delete']
        ],[ 
            'module' => 'Facilities',
            'actions' => ['index','create','store','view','edit','update','delete']
        ],[ 
            'module' => 'Modules',
            'actions' => ['index']
        ],[ 
            'module' => 'Testimonials',
            'actions' => ['index','create','store','view','edit','update','delete']
        ],[ 
            'module' => 'Quick Links',
            'actions' => ['index','create','store','view','edit','update','delete']
        ],[ 
            'module' => 'Departments',
            'actions' => ['index','create','store','view','edit','update','delete']
        ],[ 
            'module' => 'Officials',
            'actions' => ['index','create','store','view','edit','update','delete']
        ],[ 
            'module' => 'Embeddings',
            'actions' => ['index','create','store','view','edit','update','delete']
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