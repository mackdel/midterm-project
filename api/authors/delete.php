<?php 
    // Delete Author
    if($data->id) {
        // Get Data
        $author->id = $data->id;
        // Validate it 
        if(!isValid($author->id, $author)) {
            // Not Valid - Exit
            exit(json_encode( array('message' => 'author_id Not Found')));
        }

        $author->delete();

        // Create Author Array
        $author_arr = array(
            'id' => $author->id
        );

        // Display JSON of Author Array
        print_r(json_encode($author_arr));

    } else {
        echo json_encode(
            array('message' => 'Missing Required Parameters')
        );
    }