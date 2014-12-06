<?php

include '../vendor/autoload.php';

// Setting view folder
$app = new \Slim\Slim(array(
    'templates.path' => './view'
));
 

 // Default route
$app->get('/', function(){
    echo "Welcome to Slim";
}); 
 

//Show all cities
$app->get('/cities', function() use ($app) {

	include '../config.php';

	$headers = array('Accept' => 'application/json');

	$request = Requests::get($config['api_url'].'/cities', $headers);

	$jsonData = json_decode($request->body);

	$baseURL = $app->request->getRootUri();

	$app->render('cities.php', array('cities'=>$jsonData->cities, 'baseURL'=>$baseURL));

});

//Show form to create single city
$app->get('/cities/new', function() use ($app) {
	
	include '../config.php';

	$baseURL = $app->request->getRootUri();

	$app->render('new.php',array('baseURL'=>$baseURL));

});

//Show form to edit single city
$app->get('/cities/:id/edit', function($id) use ($app) {
	
	include '../config.php';

	$headers = array('Accept' => 'application/json');

	$request = Requests::get($config['api_url'].'/cities/'.$id, $headers);

	$city = json_decode($request->body);

	$baseURL = $app->request->getRootUri();

	$app->render('edit.php',array('city'=>$city,'baseURL'=>$baseURL));
});

//Update single city
$app->post('/cities/:id/update', function($id) use ($app) {

	include '../config.php';

	$headers = array('Content-Type' => 'application/json');

	$data['name'] = $_POST['name'];

	$data['id'] = $id;

	//Remember to encode the data to json when calling API on the other side
	$request = Requests::put($config['api_url'].'/cities'.$id, $headers, json_encode($data));

	echo $request->body;

});

//Delete single city
$app->post('/cities/:id/delete', function() use ($app) {

	include '../config.php';

	$headers = array('Content-Type' => 'application/json');

	//Remember to encode the data to json when calling API on the other side
	$request = Requests::delete($config['api_url'].'/cities'.$id, $headers);

	echo $request->body;

});

//Show single city
$app->get('/cities/:id', function($id) use ($app) {
	include '../config.php';

	$headers = array('Accept' => 'application/json');

	$request = Requests::get($config['api_url'].'/cities/'.$id, $headers);

	$city = json_decode($request->body);

	$baseURL = $app->request->getRootUri();

	$app->render('show.php',array('city'=>$city,'baseURL'=>$baseURL));
});

//Create single city
$app->post('/cities/', function() use ($app) {

	include '../config.php';

	$headers = array('Content-Type' => 'application/json');

	$data['name'] = $_POST['name'];

	//Remember to encode the data to json when calling API on the other side
	$request = Requests::post($config['api_url'].'/cities', $headers,json_encode($data));

	echo $request->body;

});

$app->run();