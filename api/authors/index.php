<?php
    // Headers
    header('Access-Control-Allow-Origin: *'); // can be accessed by anyone
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept ,Content-Type, X-Requested-With');
        exit();
    } else if ($method === 'POST' || $method === 'PUT' || $method === 'DELETE') {
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
    }

    // Files
    include_once '../../config/Database.php';
    include_once '../../models/Author.php';
    include_once '../../functions/isValid.php';

    // Instantiate DB & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Author Object
    $author = new Author($db);

    // Execute Request
    if ($method === 'GET') {
        // Get ID from URL
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            // Check If Exisiting Author w/ Given ID
            if(!isValid($id, $author)) {
                // Not Valid - Exit
                exit(json_encode( array('message' => 'author_id Not Found')));
            }
        } 

        if ($id) { require 'read_single.php';}
        else { require 'read.php';} 
    }
    else {
        // Get Data From Request Body
        $data = json_decode(file_get_contents("php://input"));
        switch ($method) {
            case 'POST':
                require 'create.php';
                break;
            case 'PUT':
                require 'update.php';
                break;
            default: // DELETE
            require 'delete.php';
                break;
        }
    }

    
    