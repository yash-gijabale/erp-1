<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['dashboard'] = 'welcome/dashboard';
$route['user-login'] = 'welcome/login';
$route['logout'] = 'welcome/logout';

$route['add-developers'] = 'developers/add_developers';
$route['all-developers'] = 'developers/all_developers';
$route['edit-developer'] = 'developers/edit_developer';
$route['remove-developer/(:any)'] = 'developers/remove_developer/$1';



$route['add-projects'] = 'projects/add_projects';
$route['all-projects'] = 'projects/project_list';
$route['edit-project/(:any)'] = 'projects/edit_project/$1';
$route['remove-project/(:any)'] = 'projects/remove_project/$1';
$route['add-structure'] = 'projects/add_structure';
$route['view-structure'] = 'projects/view_structure';
$route['edit-structure'] = 'projects/edit_structure';
$route['add-stage'] = 'projects/add_stage';
$route['edit-stage'] = 'projects/edit_stage';
$route['add-unit'] = 'projects/add_unit';
$route['edit-unit'] = 'projects/edit_unit';
$route['add-subunit'] = 'projects/add_subunit';
$route['edit-subunit'] = 'projects/edit_subunit';
$route['wbs-allocation'] = 'projects/allocateWBS';

$route['trade-activity'] = 'trade/trade_activity';
$route['all-trade-activity'] = 'trade/all_trade_activity';
$route['remove-tradegroup/(:any)'] = 'trade/remove_tradegroup/$1';
$route['add-tradegroup'] = 'trade/add_tradegroup';
$route['edit-tradegroup'] = 'trade/edit_tradegroup';
$route['add-trade'] = 'trade/add_trade';
$route['edit-trade'] = 'trade/edit_trade';
$route['remove-trade/(:any)'] = 'trade/remove_trade/$1';
$route['add-subgroup'] = 'trade/add_subgroup';
$route['edit-subgroup'] = 'trade/edit_subgroup';
$route['remove-subgroup/(:any)'] = 'trade/remove_subgroup/$1';
$route['add-questions'] = 'trade/add_question';
$route['edit-question/(:any)'] = 'trade/edit_question/$1';

//test import
$route['import-questions'] = 'trade/import_question';



$route['new-observation'] = 'observations/new_observation';
$route['observation-list'] = 'observations/observation_list';
$route['edit-view-observation/(:any)'] = 'observations/edit_view_observation/$1';
$route['remove-observation/(:any)'] = 'observations/remove_observation/$1';
$route['delete-image/(:any)/(:any)'] = 'observations/delete_image/$1/$2';
$route['approval-list'] = 'observations/get_approval_list';
$route['send-for-approval'] = 'observations/send_for_approval';


$route['user-list'] = 'users/user_list';
$route['new-user'] = 'users/create_user';
$route['edit-user/(:any)'] = 'users/edit_user/$1';
$route['delete-user/(:any)'] = 'users/delete_user/$1';
$route['user_access/(:any)'] = 'users/user_access_control/$1';
$route['remove-user-access/(:any)'] = 'users/remove_user_access/$1';
$route['assing-project'] = 'users/assing_project';


$route['generate-report'] = 'report/generate_report';

$route['check-list/(:any)'] = 'checklist/check_list/$1';
$route['checklist-group-master'] = 'checklist/checklist_group_master';
$route['edit-checklist-group'] = 'checklist/edit_checklist_group';
$route['remove-checklist-group/(:any)'] = 'checklist/remove_checklist_group/$1';
$route['checklist-master'] = 'checklist/checklist_master';
$route['edit-checklist-master'] = 'checklist/edit_checklist_master';
$route['remove-checklist/(:any)'] = 'checklist/remove_checklist/$1';
$route['add-checklist-subgroup'] = 'checklist/add_subgroup_to_checklist';

$route['checklist-allocation'] = 'checklistAllocation/checklistAllocation';


// CONTRACTOR MANAGEMENT
$route['contractors'] = 'contractor/contractor';
$route['add-workers'] = 'contractor/add_workers';
$route['workers-list'] = 'contractor/workers_list';
$route['add-attendance'] = 'contractor/add_attendence';
$route['profile/(:any)'] = 'contractor/view_profile/$1';


// MATERIAL MANAGEMENT
$route['material-configuration'] = 'materialManegement/add_configuration';
$route['add-measurement'] = 'materialManegement/add_measurement';
$route['add-material'] = 'materialManegement/add_material';
$route['material-list'] = 'materialManegement/material_list';
$route['supply-material'] = 'materialManegement/supply_material';
$route['supply-list'] = 'materialManegement/supply_list';



//WEB API

//logIn
$route['api/login'] = 'api/Login_api/login';
$route['api/logout'] = 'api/Login_api/logout';


//Project module
$route['api/getProjects/(:any)'] = 'api/Project_api/projectList/$1';
// $route['api/addProject'] = 'api/Project_api/add_project';
// $route['api/editProject/(:any)'] = 'api/Project_api/edit_project';
// $route['api/getStructure'] = 'api/Project_api/get_structures_by_project_id';
// $route['api/getStages'] = 'api/Project_api/get_stages_by_structure_id';
// $route['api/getUnits'] = 'api/Project_api/get_units_by_stage_id';


//Observation
$route['api/getObservations/(:any)'] = 'api/Observation_api/getObservationList/$1';
// $route['api/addObservation'] = 'api/Observation_api/newobservation';


//Trade Activity
$route['api/getTradeGroups'] = 'api/Trade_api/allTradeGroup';
$route['api/getTrades'] = 'api/Trade_api/allTrades';


//USERS
$route['api/userList/(:any)'] = 'api/User_api/userList/$1';


//CONTRACTOR
$route['api/workerList/(:any)'] = 'api/Contractor_api/getProjectWorkerList/$1';
$route['api/materialList/(:any)'] = 'api/Contractor_api/getProjectMaterialList/$1';














$route['test'] = 'welcome/test';
