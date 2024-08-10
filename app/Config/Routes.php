<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('dashboard', 'Dashboard::index',['filter' => 'authfilter']);
$routes->get('/', 'Login::index');
$routes->post('login', 'Login::auth');
$routes->get('setting', 'Setting::index',['filter' => 'authfilter']);
$routes->get('login/(:int)', 'Login::auth/$1');
$routes->get('logout', 'Login::logout');
$routes->post('online.users', 'Login::jsonList',['filter' => 'authfilter']);
$routes->post('property.json', 'Property::jsonList',['filter' => 'authfilter']);
$routes->post('detail.properties.json', 'Property::jsonListMapDetails',['filter' => 'authfilter']);
$routes->post('staff.json', 'Staff::jsonList',['filter' => 'authfilter']);
$routes->post('role.json', 'Role::jsonList',['filter' => 'authfilter']);
$routes->post('branch.json', 'Branch::jsonList',['filter' => 'authfilter']);
$routes->post('district.json', 'District::jsonList',['filter' => 'authfilter']);
$routes->post('bank.json', 'Bank::jsonList',['filter' => 'authfilter']);
$routes->post('create_bank', 'Bank::create',['filter' => 'authfilter']);
$routes->post('bank/change_status', 'Bank::change_status',['filter' => 'authfilter']);
$routes->post('bank/delete', 'Bank::delete',['filter' => 'authfilter']);
$routes->post('property_pa_valuer.json', 'Property_pa_valuer::jsonList',['filter' => 'authfilter']);
$routes->get('property', 'Property::index',['filter' => 'authfilter']);
$routes->post('property_per_user', 'Property::prop_per_user',['filter' => 'authfilter']);
$routes->get('property_pa_valuer/(:any)', 'Property::prop_per_user/$1',['filter' => 'authfilter']);
$routes->post('create_property', 'Property::create',['filter' => 'authfilter']);
$routes->get('property/view/(:any)', 'Property::view/$1',['filter' => 'authfilter']);
$routes->get('property/details/(:any)', 'Property::propertyDetails/$1',['filter' => 'authfilter']);
$routes->post('create_staff', 'Staff::create',['filter' => 'authfilter']);
$routes->post('create_branch', 'Branch::create',['filter' => 'authfilter']);
$routes->post('branch/change_status', 'Branch::change_status',['filter' => 'authfilter']);
$routes->post('branch/delete', 'Branch::delete',['filter' => 'authfilter']);
$routes->post('create_role', 'Role::create',['filter' => 'authfilter']);
$routes->post('role/change_status', 'Role::change_status',['filter' => 'authfilter']);
$routes->post('role/delete', 'Role::delete',['filter' => 'authfilter']);
$routes->post('create_district', 'District::create',['filter' => 'authfilter']);
$routes->post('district/change_status', 'District::change_status',['filter' => 'authfilter']);
$routes->post('district/delete', 'District::delete',['filter' => 'authfilter']);
$routes->get('property_pa_valuers/(:any)', 'Property_pa_valuer::index/$1',['filter' => 'authfilter']);
$routes->get('staff', 'Staff::index',['filter' => 'authfilter']);
$routes->get('staff/view/(:any)', 'Staff::view/$1',['filter' => 'authfilter']);
$routes->post('create_staff', 'Staff::create',['filter' => 'authfilter']);
$routes->post('staff/add_profile_pic', 'Staff::add_profile_pic',['filter' => 'authfilter']);
$routes->post('staff/change_status', 'Staff::change_status',['filter' => 'authfilter']);
$routes->post('staff/delete', 'Staff::delete',['filter' => 'authfilter']);
$routes->post('contact.jsonList', 'Contact::jsonList',['filter' => 'authfilter']);
$routes->post('create_contact', 'Contact::create',['filter' => 'authfilter']);
$routes->post('contact/change_status', 'Contact::change_status',['filter' => 'authfilter']);
$routes->post('contact/delete', 'Contact::delete',['filter' => 'authfilter']);
