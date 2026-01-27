<?php

use App\Constants\Actions;
use App\Constants\Modules;
use App\Constants\Permissions;

return [
  [
    'key' => 'dashboard',
    'title' => 'Dashboard',
    'icon'  => 'fa fa-dashboard',
    'route_name' => 'dashboard',
    'permission' => null,
    'is_active' => true
  ],
  [
    'key' => 'settings',
    'title' => 'Settings',
    'icon'  => 'fa fa-cogs',
    'route_name' => null,
    'permission' => [Permissions::ACADEMIC_YEARS_INDEX, Permissions::SETTINGS_INDEX],
    'children' => [
      [
        'key' => Modules::ACADEMIC_YEARS,
        'title' => 'Years',
        'icon'  => 'fa fa-university',
        'route_name' => Modules::ACADEMIC_YEARS . '.' . Actions::INDEX,
        'parent_key' => 'settings',
        'permission' => Permissions::ACADEMIC_YEARS_INDEX,
        ' is_active' => true
      ],
      [
        'key' => Modules::SETTINGS,
        'title' => 'Site Settings',
        'icon'  => 'fa fa-cog',
        'route_name' => Modules::SETTINGS . '.' . Actions::INDEX,
        'parent_key' => 'settings',
        'permission' => Permissions::SETTINGS_INDEX,
        'is_active' => true
      ],
    ],
  ],
  [
    'key' => 'user-management',
    'title' => 'User Management',
    'icon'  => 'fa fa-users',
    'route_name' => null,
    'permission' => [Permissions::ROLES_INDEX, Permissions::USERS_INDEX],
    'children' => [
      [
        'key' => Modules::ROLES,
        'title' => Modules::ROLES,
        'icon'  => 'fa fa-group',
        'route_name' => Modules::ROLES . '.' . Actions::INDEX,
        'parent_key' => 'user-management',
        'permission' => Permissions::ROLES_INDEX,
        'is_active' => true
      ],
      [
        'key' => Modules::USERS,
        'title' => 'Users',
        'icon'  => 'fa fa-user-circle-o',
        'route_name' => Modules::USERS . '.' . Actions::INDEX,
        'parent_key' => 'user-management',
        'permission' => Permissions::USERS_INDEX,
        'is_active' => true
      ],
    ],
  ],
  [
    'key' => 'core-modules',
    'title' => 'Core Modules',
    'icon'  => 'fa fa-folder',
    'route_name' => null,
    'permission' => [
      Permissions::DEPARTMENTS_INDEX,
      Permissions::DESIGNATIONS_INDEX,
      Permissions::DOCUMENT_TYPES_INDEX,
      Permissions::POST_CATEGORIES_INDEX
    ],
    'children' => [
      [
        'key' => Modules::DEPARTMENTS,
        'title' => Modules::DEPARTMENTS,
        'icon'  => 'fa fa-university',
        'route_name' => Modules::DEPARTMENTS . '.' . Actions::INDEX,
        'parent_key' => 'core-modules',
        'permission' => Permissions::DEPARTMENTS_INDEX,
        'is_active' => true
      ],
      [
        'key' => Modules::DESIGNATIONS,
        'title' => Modules::DESIGNATIONS,
        'icon'  => 'fa fa-black-tie',
        'route_name' => Modules::DESIGNATIONS . '.' . Actions::INDEX,
        'parent_key' => 'core-modules',
        'permission' => Permissions::DESIGNATIONS_INDEX,
        'is_active' => true
      ],
      [
        'key' => Modules::DOCUMENT_TYPES,
        'title' => 'Document Types',
        'icon'  => 'fa fa-file',
        'route_name' => Modules::DOCUMENT_TYPES . '.' . Actions::INDEX,
        'parent_key' => 'core-modules',
        'permission' => Permissions::DOCUMENT_TYPES_INDEX,
        'is_active' => true
      ],
      [
        'key' => Modules::POST_CATEGORIES,
        'title' => 'Post Categories',
        'icon'  => 'fa fa-sticky-note-o',
        'route_name' => Modules::POST_CATEGORIES . '.' . Actions::INDEX,
        'parent_key' => 'core-modules',
        'permission' => Permissions::POST_CATEGORIES_INDEX,
        'is_active' => true
      ],
    ],
  ],
  [
    'key' => Modules::BANNERS,
    'title' => 'Banners',
    'icon'  => 'fa fa-image',
    'route_name' => Modules::BANNERS . '.' . Actions::INDEX,
    'permission' => Permissions::BANNERS_INDEX,
    'is_active' => true
  ],
  [
    'key' => Modules::PAGES,
    'title' => 'Pages',
    'icon'  => 'fa fa-file-text-o',
    'route_name' => Modules::PAGES . '.' . Actions::INDEX,
    'permission' => Permissions::PAGES_INDEX,
    'is_active' => true
  ],
  [
    'key' => Modules::POSTS,
    'title' => 'Posts',
    'icon'  => 'fa fa-edit',
    'route_name' => Modules::POSTS . '.' . Actions::INDEX,
    'permission' => Permissions::POSTS_INDEX,
    'is_active' => true
  ],
  [
    'key' => Modules::EVENTS,
    'title' => 'Events',
    'icon'  => 'fa fa-calendar',
    'route_name' => Modules::EVENTS . '.' . Actions::INDEX,
    'permission' => Permissions::EVENTS_INDEX,
    'is_active' => false
  ],
  [
    'key' => Modules::DOCUMENTS,
    'title' => 'Publications',
    'icon'  => 'fa fa-file',
    'route_name' => Modules::DOCUMENTS . '.' . Actions::INDEX,
    'permission' => Permissions::DOCUMENTS_INDEX,
    'is_active' => true
  ],
  [
    'key' => Modules::OFFICIALS,
    'title' => 'Officials',
    'icon'  => 'fa fa-user',
    'route_name' => Modules::OFFICIALS . '.' . Actions::INDEX,
    'permission' => Permissions::OFFICIALS_INDEX,
    'is_active' => true
  ],
  [
    'key' => Modules::PROGRAMS,
    'title' => 'Programs',
    'icon'  => 'fa fa-graduation-cap',
    'route_name' => Modules::PROGRAMS . '.' . Actions::INDEX,
    'permission' => Permissions::PROGRAMS_INDEX,
    'is_active' => false
  ],
  [
    'key' => Modules::FACILITIES,
    'title' => 'Facilities',
    'icon'  => 'fa fa-building',
    'route_name' => Modules::FACILITIES . '.' . Actions::INDEX,
    'permission' => Permissions::FACILITIES_INDEX,
    'is_active' => true
  ],
  [
    'key' => Modules::GALLERIES,
    'title' => 'Gallery',
    'icon'  => 'fa fa-image',
    'route_name' => Modules::GALLERIES . '.' . Actions::INDEX,
    'permission' => Permissions::GALLERIES_INDEX,
    'is_active' => true
  ],
  [
    'key' => Modules::EMBEDDINGS,
    'title' => 'Embeddings',
    'icon'  => 'fa fa-file-code-o',
    'route_name' => Modules::EMBEDDINGS . '.' . Actions::INDEX,
    'permission' => Permissions::EMBEDDINGS_INDEX,
    'is_active' => true
  ],
  [
    'key' => Modules::QUICK_LINKS,
    'title' => 'Quick Links',
    'icon'  => 'fa fa-external-link',
    'route_name' => Modules::QUICK_LINKS . '.' . Actions::INDEX,
    'permission' => Permissions::QUICK_LINKS_INDEX,
    'is_active' => true
  ],
  [
    'key' => Modules::VISITOR_QUERIES,
    'title' => 'Visitor Queries',
    'icon'  => 'fa fa-comments',
    'route_name' => Modules::VISITOR_QUERIES . '.' . Actions::INDEX,
    'permission' => Permissions::VISITOR_QUERIES_INDEX,
    'is_active' => true
  ],
];
