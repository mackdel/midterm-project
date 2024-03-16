<?php
    // Create Author
    if(isset($data->author)) {
        $author->author = $data->author;

        $author->create();
        
        // Create Author Array
        $author_arr = array(
            'id' => $db->lastInsertID(),
            'author' => $author->author
        );

        // Display JSON of Author Array
        print_r(json_encode($author_arr));
    } else {
        echo json_encode(
            array('message' => 'Missing Required Parameters')
        );
    }