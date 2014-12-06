<?php

include '../vendor/autoload.php';

// Database Connection
include 'database.php';

// Setting view folder
$app = new \Slim\Slim(array(
    'templates.path' => './view'
));
 

 // Default route
$app->get('/', function(){
    echo "Welcome to Slim";
}); 


// Using view 
$app->get('/test-page', function() use ($app) {
    $app->render('/test-page.php');
});

// Simple parameter
$app->get('/halo/:nama', function($nama){
	echo "Halo {$nama}";
});

//List all cities
$app->get('/cities', function() use ($app) {

	//Set JSON Header
	$app->response()->header('Content-Type', 'application/json;charset=utf-8');

	try {
		$db = getConnection();
		$sql = "select * FROM cities ORDER BY name";
		$stmt = $db->query($sql);
		$cities = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$db = null;
		echo '{"cities": ' . json_encode($cities) . '}';
	} catch (PDOException $e) {
		echo '{"error": {"text": '. $e->getMessage() .'}}';
	}
});

//Get single city by:id
$app->get('/cities/:id', function($id) use ($app) {

	//Set JSON Header
	$app->response()->header('Content-Type', 'application/json;charset=utf-8');

	$sql = "SELECT * FROM cities WHERE id=:id";

	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$city = $stmt->fetchObject();
		$db = null;
		echo json_encode($city);
	} catch (PDOException $e) {
		echo '{"error": {"text": '. $e->getMessage() .'}}';
	}
});

//Update single city by :id
$app->put('/cities/:id', function($id) use ($app) {

	//Set JSON Header
	$app->response()->header('Content-Type', 'application/json;charset=utf-8');

	$body = $app->request->getBody();

	$city = json_decode($body);

	$sql = "UPDATE cities SET name=:name WHERE id=:id";

	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("name", $city->name);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$db = null;
		echo json_encode(array('message'=>"Update city with id=$id success"));
	} catch (PDOException $e) {
		echo '{"error": {"text": '. $e->getMessage() .'}}';
	}
});

//Delete single city by :id
$app->delete('/cities/:id', function($id) use ($app) {

	//Set JSON Header
	$app->response()->header('Content-Type', 'application/json;charset=utf-8');

	$sql = "DELETE FROM cities WHERE id=:id";

	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$db = null;
		echo json_encode(array('message'=>"Delete city with id=$id success"));

	} catch (PDOException $e) {
		echo '{"error": {"text": '. $e->getMessage() .'}}';
	}
});

//Create single city
$app->post('/cities', function() use ($app) {

	//Set JSON Header
	$app->response()->header('Content-Type', 'application/json;charset=utf-8');

	$request = $app->request();

	$city = json_decode($request->getBody());

	$sql = "INSERT INTO cities (name) VALUES (:name)";

	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("name", $city->name);
		$stmt->execute();
		$city->id = $db->lastInsertId();

		$db = null;
		
		echo json_encode(array('message'=>'Success create a new city','city'=>$city));

	} catch (PDOException $e) {
		echo '{"error": {"text": '. $e->getMessage() .'}}';
	}
});

$app->run();