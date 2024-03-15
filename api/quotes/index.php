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
    include_once '../../models/Quote.php';
    include_once '../../functions/isValid.php';
    include_once '../../models/Author.php';
    include_once '../../models/Category.php';
    
    // Instantiate DB & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Quote
    $quote = new Quote($db);
    // Instantiate Author & Category for ID Testing
    $author = new Author($db);
    $category = new Category($db);
    
    $id = null;
    // Execute Request
    if ($method === 'GET') {
        
        // Get ID from URL
        if (isset($_GET['id'])) {
            // Quote ID Given
            $id = $_GET['id'];

            // Check If Exisiting Quote w/ Given ID
            if(!isValid($id, $quote)) {
                // Not Valid - Exit
                exit(json_encode( array('message' => 'No Quotes Found')));
            }
        } 
        if (isset($_GET['author_id'])) {
            // Author ID Given
            $quote->author_id = $_GET['author_id'];

            // Check If Exisiting Author w/ Given ID
            if(!isValid($quote->author_id, $author)) {
                // Not Valid - Exit
                exit(json_encode( array('message' => 'author_id Not Found')));
            }

        } 
        if (isset($_GET['category_id'])) {
            // Category ID Given
            $quote->category_id = $_GET['category_id'];

            // Check If Exisiting Category w/ Given ID
            if(!isValid($quote->category_id, $category)) {
                // Not Valid - Exit
                exit(json_encode( array('message' => 'category_id Not Found')));
            }
        } 

        // Read ID-Specific Quotes
        if ($id || $quote->author_id || $quote->category_id) { require 'read_single.php';}
        // Read All Quotes
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
    
