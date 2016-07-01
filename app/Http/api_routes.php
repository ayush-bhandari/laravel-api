<?php
	
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {


$api->group(['middleware' => ['cors']], function ($api) {
	$api->post('auth/login', 'App\Api\V1\Controllers\AuthController@login');
	$api->post('auth/signup', 'App\Api\V1\Controllers\AuthController@signup');
	$api->post('auth/recovery', 'App\Api\V1\Controllers\AuthController@recovery');
	$api->post('auth/reset', 'App\Api\V1\Controllers\AuthController@reset');
	
	$api->post('auth/assignRole', 'App\Api\V1\Controllers\AuthController@assignRole');
	$api->post('auth/attachPermission', 'App\Api\V1\Controllers\AuthController@attachPermission');

});

	// example of protected route
	$api->get('protected', ['middleware' => ['api.auth'], function () {		
		return \App\User::all();
    }]);

	// example of free route
	$api->get('free', function() {
		return \App\User::all();
	});

	$api->group(['middleware' => ['ability:admin,super-user']], function ($api) {
			
			$api->post('auth/createRole', 'App\Api\V1\Controllers\AuthController@createRole');
			$api->post('auth/createPermission', 'App\Api\V1\Controllers\AuthController@createPermission');
			// $api->post('auth/assignRole', 'App\Api\V1\Controllers\AuthController@assignRole');
			// $api->post('auth/attachPermission', 'App\Api\V1\Controllers\AuthController@attachPermission');

			
	});


});
