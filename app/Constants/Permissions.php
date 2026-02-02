<?php

namespace App\Constants;

final class Permissions
{
  // Years Permissions
  public const ACADEMIC_YEARS_INDEX = Modules::ACADEMIC_YEARS . '.' . Actions::INDEX;
  public const ACADEMIC_YEARS_CREATE = Modules::ACADEMIC_YEARS . '.' . Actions::CREATE;
  public const ACADEMIC_YEARS_STORE = Modules::ACADEMIC_YEARS . '.' . Actions::STORE;
  public const ACADEMIC_YEARS_VIEW = Modules::ACADEMIC_YEARS . '.' . Actions::VIEW;
  public const ACADEMIC_YEARS_EDIT = Modules::ACADEMIC_YEARS . '.' . Actions::EDIT;
  public const ACADEMIC_YEARS_UPDATE = Modules::ACADEMIC_YEARS . '.' . Actions::UPDATE;
  public const ACADEMIC_YEARS_DELETE = Modules::ACADEMIC_YEARS . '.' . Actions::DELETE;

  // Settings Permissions
  public const SETTINGS_INDEX = Modules::SETTINGS . '.' . Actions::INDEX;
  public const SETTINGS_EDIT = Modules::SETTINGS . '.' . Actions::EDIT;
  public const SETTINGS_UPDATE = Modules::SETTINGS . '.' . Actions::UPDATE;

  // Roles Permissions
  public const ROLES_INDEX = Modules::ROLES . '.' . Actions::INDEX;
  public const ROLES_CREATE = Modules::ROLES . '.' . Actions::CREATE;
  public const ROLES_STORE = Modules::ROLES . '.' . Actions::STORE;
  public const ROLES_VIEW = Modules::ROLES . '.' . Actions::VIEW;
  public const ROLES_EDIT = Modules::ROLES . '.' . Actions::EDIT;
  public const ROLES_UPDATE = Modules::ROLES . '.' . Actions::UPDATE;
  public const ROLES_DELETE = Modules::ROLES . '.' . Actions::DELETE;

  // Users Permissions
  public const USERS_INDEX = Modules::USERS . '.' . Actions::INDEX;
  public const USERS_CREATE = Modules::USERS . '.' . Actions::CREATE;
  public const USERS_STORE = Modules::USERS . '.' . Actions::STORE;
  public const USERS_VIEW = Modules::USERS . '.' . Actions::VIEW;
  public const USERS_EDIT = Modules::USERS . '.' . Actions::EDIT;
  public const USERS_UPDATE = Modules::USERS . '.' . Actions::UPDATE;
  public const USERS_DELETE = Modules::USERS . '.' . Actions::DELETE;
  public const USERS_RESTORE_PASSWORD = Modules::USERS . '.' . Actions::RESTORE_PASSWORD;

  // Role Permissions
  public const ROLE_PERMISSIONS_INDEX = Modules::ROLE_PERMISSIONS . '.' . Actions::INDEX;
  public const ROLE_PERMISSIONS_CREATE = Modules::ROLE_PERMISSIONS . '.' . Actions::CREATE;
  public const ROLE_PERMISSIONS_STORE = Modules::ROLE_PERMISSIONS . '.' . Actions::STORE;
  public const ROLE_PERMISSIONS_VIEW = Modules::ROLE_PERMISSIONS . '.' . Actions::VIEW;
  public const ROLE_PERMISSIONS_EDIT = Modules::ROLE_PERMISSIONS . '.' . Actions::EDIT;
  public const ROLE_PERMISSIONS_UPDATE = Modules::ROLE_PERMISSIONS . '.' . Actions::UPDATE;
  public const ROLE_PERMISSIONS_DELETE = Modules::ROLE_PERMISSIONS . '.' . Actions::DELETE;

  // User Permissions
  public const USER_PERMISSIONS_INDEX = Modules::USER_PERMISSIONS . '.' . Actions::INDEX;
  public const USER_PERMISSIONS_CREATE = Modules::USER_PERMISSIONS . '.' . Actions::CREATE;
  public const USER_PERMISSIONS_STORE = Modules::USER_PERMISSIONS . '.' . Actions::STORE;
  public const USER_PERMISSIONS_VIEW = Modules::USER_PERMISSIONS . '.' . Actions::VIEW;
  public const USER_PERMISSIONS_EDIT = Modules::USER_PERMISSIONS . '.' . Actions::EDIT;
  public const USER_PERMISSIONS_UPDATE = Modules::USER_PERMISSIONS . '.' . Actions::UPDATE;
  public const USER_PERMISSIONS_DELETE = Modules::USER_PERMISSIONS . '.' . Actions::DELETE;

  // Profile Permissions
  public const PROFILE_INDEX = Modules::PROFILE . '.' . Actions::INDEX;
  public const PROFILE_EDIT = Modules::PROFILE . '.' . Actions::EDIT;
  public const PROFILE_UPDATE = Modules::PROFILE . '.' . Actions::UPDATE;

  // Departments Permissions
  public const DEPARTMENTS_INDEX = Modules::DEPARTMENTS . '.' . Actions::INDEX;
  public const DEPARTMENTS_CREATE = Modules::DEPARTMENTS . '.' . Actions::CREATE;
  public const DEPARTMENTS_STORE = Modules::DEPARTMENTS . '.' . Actions::STORE;
  public const DEPARTMENTS_VIEW = Modules::DEPARTMENTS . '.' . Actions::VIEW;
  public const DEPARTMENTS_EDIT = Modules::DEPARTMENTS . '.' . Actions::EDIT;
  public const DEPARTMENTS_UPDATE = Modules::DEPARTMENTS . '.' . Actions::UPDATE;
  public const DEPARTMENTS_DELETE = Modules::DEPARTMENTS . '.' . Actions::DELETE;

  // Designations Permissions
  public const DESIGNATIONS_INDEX = Modules::DESIGNATIONS . '.' . Actions::INDEX;
  public const DESIGNATIONS_CREATE = Modules::DESIGNATIONS . '.' . Actions::CREATE;
  public const DESIGNATIONS_STORE = Modules::DESIGNATIONS . '.' . Actions::STORE;
  public const DESIGNATIONS_VIEW = Modules::DESIGNATIONS . '.' . Actions::VIEW;
  public const DESIGNATIONS_EDIT = Modules::DESIGNATIONS . '.' . Actions::EDIT;
  public const DESIGNATIONS_UPDATE = Modules::DESIGNATIONS . '.' . Actions::UPDATE;
  public const DESIGNATIONS_DELETE = Modules::DESIGNATIONS . '.' . Actions::DELETE;

  // Officials Permissions
  public const OFFICIALS_INDEX = Modules::OFFICIALS . '.' . Actions::INDEX;
  public const OFFICIALS_CREATE = Modules::OFFICIALS . '.' . Actions::CREATE;
  public const OFFICIALS_STORE = Modules::OFFICIALS . '.' . Actions::STORE;
  public const OFFICIALS_VIEW = Modules::OFFICIALS . '.' . Actions::VIEW;
  public const OFFICIALS_EDIT = Modules::OFFICIALS . '.' . Actions::EDIT;
  public const OFFICIALS_UPDATE = Modules::OFFICIALS . '.' . Actions::UPDATE;
  public const OFFICIALS_DELETE = Modules::OFFICIALS . '.' . Actions::DELETE;

  // Document Types Permissions
  public const DOCUMENT_TYPES_INDEX = Modules::DOCUMENT_TYPES . '.' . Actions::INDEX;
  public const DOCUMENT_TYPES_CREATE = Modules::DOCUMENT_TYPES . '.' . Actions::CREATE;
  public const DOCUMENT_TYPES_STORE = Modules::DOCUMENT_TYPES . '.' . Actions::STORE;
  public const DOCUMENT_TYPES_VIEW = Modules::DOCUMENT_TYPES . '.' . Actions::VIEW;
  public const DOCUMENT_TYPES_EDIT = Modules::DOCUMENT_TYPES . '.' . Actions::EDIT;
  public const DOCUMENT_TYPES_UPDATE = Modules::DOCUMENT_TYPES . '.' . Actions::UPDATE;
  public const DOCUMENT_TYPES_DELETE = Modules::DOCUMENT_TYPES . '.' . Actions::DELETE;

  // Documents Permissions
  public const DOCUMENTS_INDEX = Modules::DOCUMENTS . '.' . Actions::INDEX;
  public const DOCUMENTS_CREATE = Modules::DOCUMENTS . '.' . Actions::CREATE;
  public const DOCUMENTS_STORE = Modules::DOCUMENTS . '.' . Actions::STORE;
  public const DOCUMENTS_VIEW = Modules::DOCUMENTS . '.' . Actions::VIEW;
  public const DOCUMENTS_EDIT = Modules::DOCUMENTS . '.' . Actions::EDIT;
  public const DOCUMENTS_UPDATE = Modules::DOCUMENTS . '.' . Actions::UPDATE;
  public const DOCUMENTS_DELETE = Modules::DOCUMENTS . '.' . Actions::DELETE;

  // Post Categories Permissions
  public const POST_CATEGORIES_INDEX = Modules::POST_CATEGORIES . '.' . Actions::INDEX;
  public const POST_CATEGORIES_CREATE = Modules::POST_CATEGORIES . '.' . Actions::CREATE;
  public const POST_CATEGORIES_STORE = Modules::POST_CATEGORIES . '.' . Actions::STORE;
  public const POST_CATEGORIES_VIEW = Modules::POST_CATEGORIES . '.' . Actions::VIEW;
  public const POST_CATEGORIES_EDIT = Modules::POST_CATEGORIES . '.' . Actions::EDIT;
  public const POST_CATEGORIES_UPDATE = Modules::POST_CATEGORIES . '.' . Actions::UPDATE;
  public const POST_CATEGORIES_DELETE = Modules::POST_CATEGORIES . '.' . Actions::DELETE;

  // Posts Permissions
  public const POSTS_INDEX = Modules::POSTS . '.' . Actions::INDEX;
  public const POSTS_CREATE = Modules::POSTS . '.' . Actions::CREATE;
  public const POSTS_STORE = Modules::POSTS . '.' . Actions::STORE;
  public const POSTS_VIEW = Modules::POSTS . '.' . Actions::VIEW;
  public const POSTS_EDIT = Modules::POSTS . '.' . Actions::EDIT;
  public const POSTS_UPDATE = Modules::POSTS . '.' . Actions::UPDATE;
  public const POSTS_DELETE = Modules::POSTS . '.' . Actions::DELETE;

  // Events Permissions
  public const EVENTS_INDEX = Modules::EVENTS . '.' . Actions::INDEX;
  public const EVENTS_CREATE = Modules::EVENTS . '.' . Actions::CREATE;
  public const EVENTS_STORE = Modules::EVENTS . '.' . Actions::STORE;
  public const EVENTS_VIEW = Modules::EVENTS . '.' . Actions::VIEW;
  public const EVENTS_EDIT = Modules::EVENTS . '.' . Actions::EDIT;
  public const EVENTS_UPDATE = Modules::EVENTS . '.' . Actions::UPDATE;
  public const EVENTS_DELETE = Modules::EVENTS . '.' . Actions::DELETE;

  // Pages Permissions
  public const PAGES_INDEX = Modules::PAGES . '.' . Actions::INDEX;
  public const PAGES_CREATE = Modules::PAGES . '.' . Actions::CREATE;
  public const PAGES_STORE = Modules::PAGES . '.' . Actions::STORE;
  public const PAGES_VIEW = Modules::PAGES . '.' . Actions::VIEW;
  public const PAGES_EDIT = Modules::PAGES . '.' . Actions::EDIT;
  public const PAGES_UPDATE = Modules::PAGES . '.' . Actions::UPDATE;
  public const PAGES_DELETE = Modules::PAGES . '.' . Actions::DELETE;

  // Facilities Permissions
  public const FACILITIES_INDEX = Modules::FACILITIES . '.' . Actions::INDEX;
  public const FACILITIES_CREATE = Modules::FACILITIES . '.' . Actions::CREATE;
  public const FACILITIES_STORE = Modules::FACILITIES . '.' . Actions::STORE;
  public const FACILITIES_VIEW = Modules::FACILITIES . '.' . Actions::VIEW;
  public const FACILITIES_EDIT = Modules::FACILITIES . '.' . Actions::EDIT;
  public const FACILITIES_UPDATE = Modules::FACILITIES . '.' . Actions::UPDATE;
  public const FACILITIES_DELETE = Modules::FACILITIES . '.' . Actions::DELETE;

  // Visitor Queries Permissions
  public const VISITOR_QUERIES_INDEX = Modules::VISITOR_QUERIES . '.' . Actions::INDEX;
  public const VISITOR_QUERIES_VIEW = Modules::VISITOR_QUERIES . '.' . Actions::VIEW;
  public const VISITOR_QUERIES_DELETE = Modules::VISITOR_QUERIES . '.' . Actions::DELETE;

  // Banners Permissions
  public const BANNERS_INDEX = Modules::BANNERS . '.' . Actions::INDEX;
  public const BANNERS_CREATE = Modules::BANNERS . '.' . Actions::CREATE;
  public const BANNERS_STORE = Modules::BANNERS . '.' . Actions::STORE;
  public const BANNERS_VIEW = Modules::BANNERS . '.' . Actions::VIEW;
  public const BANNERS_EDIT = Modules::BANNERS . '.' . Actions::EDIT;
  public const BANNERS_UPDATE = Modules::BANNERS . '.' . Actions::UPDATE;
  public const BANNERS_DELETE = Modules::BANNERS . '.' . Actions::DELETE;

  // Galleries Permissions
  public const GALLERIES_INDEX = Modules::GALLERIES . '.' . Actions::INDEX;
  public const GALLERIES_CREATE = Modules::GALLERIES . '.' . Actions::CREATE;
  public const GALLERIES_STORE = Modules::GALLERIES . '.' . Actions::STORE;
  public const GALLERIES_VIEW = Modules::GALLERIES . '.' . Actions::VIEW;
  public const GALLERIES_EDIT = Modules::GALLERIES . '.' . Actions::EDIT;
  public const GALLERIES_UPDATE = Modules::GALLERIES . '.' . Actions::UPDATE;
  public const GALLERIES_DELETE = Modules::GALLERIES . '.' . Actions::DELETE;

  // Training Categories Permissions
  public const TRAINING_CATEGORIES_INDEX = Modules::TRAINING_CATEGORIES . '.' . Actions::INDEX;
  public const TRAINING_CATEGORIES_CREATE = Modules::TRAINING_CATEGORIES . '.' . Actions::CREATE;
  public const TRAINING_CATEGORIES_STORE = Modules::TRAINING_CATEGORIES . '.' . Actions::STORE;
  public const TRAINING_CATEGORIES_VIEW = Modules::TRAINING_CATEGORIES . '.' . Actions::VIEW;
  public const TRAINING_CATEGORIES_EDIT = Modules::TRAINING_CATEGORIES . '.' . Actions::EDIT;
  public const TRAINING_CATEGORIES_UPDATE = Modules::TRAINING_CATEGORIES . '.' . Actions::UPDATE;
  public const TRAINING_CATEGORIES_DELETE = Modules::TRAINING_CATEGORIES . '.' . Actions::DELETE;

  // Training Types Permissions
  public const TRAINING_TYPES_INDEX = Modules::TRAINING_TYPES . '.' . Actions::INDEX;
  public const TRAINING_TYPES_CREATE = Modules::TRAINING_TYPES . '.' . Actions::CREATE;
  public const TRAINING_TYPES_STORE = Modules::TRAINING_TYPES . '.' . Actions::STORE;
  public const TRAINING_TYPES_VIEW = Modules::TRAINING_TYPES . '.' . Actions::VIEW;
  public const TRAINING_TYPES_EDIT = Modules::TRAINING_TYPES . '.' . Actions::EDIT;
  public const TRAINING_TYPES_UPDATE = Modules::TRAINING_TYPES . '.' . Actions::UPDATE;
  public const TRAINING_TYPES_DELETE = Modules::TRAINING_TYPES . '.' . Actions::DELETE;

  // Trainings Permissions
  public const TRAININGS_INDEX = Modules::TRAININGS . '.' . Actions::INDEX;
  public const TRAININGS_CREATE = Modules::TRAININGS . '.' . Actions::CREATE;
  public const TRAININGS_STORE = Modules::TRAININGS . '.' . Actions::STORE;
  public const TRAININGS_VIEW = Modules::TRAININGS . '.' . Actions::VIEW;
  public const TRAININGS_EDIT = Modules::TRAININGS . '.' . Actions::EDIT;
  public const TRAININGS_UPDATE = Modules::TRAININGS . '.' . Actions::UPDATE;
  public const TRAININGS_DELETE = Modules::TRAININGS . '.' . Actions::DELETE;

  // Programs Permissions
  public const PROGRAMS_INDEX = Modules::PROGRAMS . '.' . Actions::INDEX;
  public const PROGRAMS_CREATE = Modules::PROGRAMS . '.' . Actions::CREATE;
  public const PROGRAMS_STORE = Modules::PROGRAMS . '.' . Actions::STORE;
  public const PROGRAMS_VIEW = Modules::PROGRAMS . '.' . Actions::VIEW;
  public const PROGRAMS_EDIT = Modules::PROGRAMS . '.' . Actions::EDIT;
  public const PROGRAMS_UPDATE = Modules::PROGRAMS . '.' . Actions::UPDATE;
  public const PROGRAMS_DELETE = Modules::PROGRAMS . '.' . Actions::DELETE;

  // Modules Permissions
  public const MODULES_INDEX = Modules::MODULES . '.' . Actions::INDEX;

  // Testimonials Permissions
  public const TESTIMONIALS_INDEX = Modules::TESTIMONIALS . '.' . Actions::INDEX;
  public const TESTIMONIALS_CREATE = Modules::TESTIMONIALS . '.' . Actions::CREATE;
  public const TESTIMONIALS_STORE = Modules::TESTIMONIALS . '.' . Actions::STORE;
  public const TESTIMONIALS_VIEW = Modules::TESTIMONIALS . '.' . Actions::VIEW;
  public const TESTIMONIALS_EDIT = Modules::TESTIMONIALS . '.' . Actions::EDIT;
  public const TESTIMONIALS_UPDATE = Modules::TESTIMONIALS . '.' . Actions::UPDATE;
  public const TESTIMONIALS_DELETE = Modules::TESTIMONIALS . '.' . Actions::DELETE;

  // Quick Links Permissions
  public const QUICK_LINKS_INDEX = Modules::QUICK_LINKS . '.' . Actions::INDEX;
  public const QUICK_LINKS_CREATE = Modules::QUICK_LINKS . '.' . Actions::CREATE;
  public const QUICK_LINKS_STORE = Modules::QUICK_LINKS . '.' . Actions::STORE;
  public const QUICK_LINKS_VIEW = Modules::QUICK_LINKS . '.' . Actions::VIEW;
  public const QUICK_LINKS_EDIT = Modules::QUICK_LINKS . '.' . Actions::EDIT;
  public const QUICK_LINKS_UPDATE = Modules::QUICK_LINKS . '.' . Actions::UPDATE;
  public const QUICK_LINKS_DELETE = Modules::QUICK_LINKS . '.' . Actions::DELETE;

  // Embeddings Permissions
  public const EMBEDDINGS_INDEX = Modules::EMBEDDINGS . '.' . Actions::INDEX;
  public const EMBEDDINGS_CREATE = Modules::EMBEDDINGS . '.' . Actions::CREATE;
  public const EMBEDDINGS_STORE = Modules::EMBEDDINGS . '.' . Actions::STORE;
  public const EMBEDDINGS_VIEW = Modules::EMBEDDINGS . '.' . Actions::VIEW;
  public const EMBEDDINGS_EDIT = Modules::EMBEDDINGS . '.' . Actions::EDIT;
  public const EMBEDDINGS_UPDATE = Modules::EMBEDDINGS . '.' . Actions::UPDATE;
  public const EMBEDDINGS_DELETE = Modules::EMBEDDINGS . '.' . Actions::DELETE;
}
