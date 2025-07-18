<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// ===================================================================
// مسارات موديول تهيئة المدخلات (مكتمل)
// ===================================================================
$routes->group('lookups', function ($routes) {
    $routes->get('/', 'Lookups::index');
    // Groups
    $routes->get('new-group', 'Lookups::newGroup');
    $routes->post('create-group', 'Lookups::createGroup');
    $routes->get('edit-group/(:any)', 'Lookups::editGroup/$1');
    $routes->post('update-group', 'Lookups::updateGroup');
    $routes->post('delete-group/(:any)', 'Lookups::deleteGroup/$1');
    // Options
    $routes->get('new-option/(:any)', 'Lookups::newOption/$1');
    $routes->post('create-option', 'Lookups::createOption');
    $routes->get('edit-option/(:num)', 'Lookups::editOption/$1');
    $routes->post('update-option', 'Lookups::updateOption');
    $routes->post('delete-option/(:num)', 'Lookups::deleteOption/$1');
});


// ===================================================================
// (جديد) مسارات إدارة نظام الأمان (RBAC & Users)
// ===================================================================

// --- 1. مسارات إدارة الصلاحيات ---
$routes->group('permissions', function ($routes) {
    $routes->get('/', 'Permissions::index');
    // Groups
    $routes->get('new-group', 'Permissions::newGroup');
    $routes->post('create-group', 'Permissions::createGroup');
    $routes->get('edit-group/(:num)', 'Permissions::editGroup/$1');
    $routes->post('update-group', 'Permissions::updateGroup');
    $routes->post('delete-group/(:num)', 'Permissions::deleteGroup/$1');
    // Permissions
    $routes->get('new/(:num)', 'Permissions::newPermission/$1');
    $routes->post('create', 'Permissions::createPermission');
    $routes->get('edit/(:num)', 'Permissions::editPermission/$1');
    $routes->post('update', 'Permissions::updatePermission');
    $routes->post('delete/(:num)', 'Permissions::deletePermission/$1');
});

// --- 2. مسارات إدارة الأدوار ---
$routes->group('roles', function ($routes) {
    $routes->get('/', 'Roles::index');
    $routes->get('new', 'Roles::new');
    $routes->post('create', 'Roles::create');
    $routes->get('edit/(:num)', 'Roles::edit/$1');
    $routes->post('update', 'Roles::update');
    $routes->post('delete/(:num)', 'Roles::delete/$1');
    // Special route for assigning permissions
    $routes->get('permissions/(:num)', 'Roles::editPermissions/$1');
    $routes->post('save-permissions', 'Roles::savePermissions');
});

// --- 3. مسارات إدارة المستخدمين ---
$routes->group('users', function ($routes) {
    $routes->get('/', 'Users::index');
    $routes->get('new', 'Users::new');
    $routes->post('create', 'Users::create');
    $routes->get('edit/(:num)', 'Users::edit/$1');
    $routes->post('update', 'Users::update');
    $routes->post('delete/(:num)', 'Users::delete/$1');
});