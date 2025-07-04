<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// ===================================================================
// مسارات موديول تهيئة المدخلات
// ===================================================================

// --- مسارات عرض البيانات ---
$routes->get('lookups', 'Lookups::index');

// --- مسارات إضافة مجموعة ---
$routes->get('lookups/new-group', 'Lookups::newGroup');
$routes->post('lookups/create-group', 'Lookups::createGroup');

// --- (جديد) مسارات تعديل مجموعة ---
$routes->get('lookups/edit-group/(:any)', 'Lookups::editGroup/$1');
$routes->post('lookups/update-group', 'Lookups::updateGroup');