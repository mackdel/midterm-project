<?php
    // Update Author
    if($data->author && $data->id) {
        // Get Data & Validate it 
        $author->id = $data->id;
        if(!isValid($author->id, $author)) {
            // Not Valid - Exit
            exit(json_encode( array('message' => 'author_id Not Found')));
        }
        $author->author = $data->author;

        $author->update();
        
        // Create Author Array
        $author_arr = array(
            'id' => $author->id,
            'author' => $author->author
        );

        // Display JSON of Author Array
        print_r(json_encode($author_arr));
    } else {
        echo json_encode(
            array('message' => 'Missing Required Parameters')
        );
    }