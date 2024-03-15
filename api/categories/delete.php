<?php 
    // Delete Category
    if($data->id) {
        // Get Data
        $category->id = $data->id;
        // Validate it 
        if(!isValid($category->id, $category)) {
            // Not Valid - Exit
            exit(json_encode( array('message' => 'category_id Not Found')));
        }

        $category->delete();

        // Create Category Array
        $category_arr = array(
            'id' => $category->id
        );

        // Display JSON of Category Array
        print_r(json_encode($category_arr));

    } else {
        echo json_encode(
            array('message' => 'Missing Required Parameters')
        );
    }