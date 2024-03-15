<?php
    // Update Category
    if($data->category && $data->id) {
        // Get Data & Validate it 
        $category->id = $data->id;
        if(!isValid($category->id, $category)) {
            // Not Valid - Exit
            exit(json_encode( array('message' => 'category_id Not Found')));
        }
        $category->category = $data->category;

        $category->update();
        
        // Create Category Array
        $category_arr = array(
            'id' => $category->id,
            'category' => $category->category
        );

        // Display JSON of Category Array
        print_r(json_encode($category_arr));
    } else {
        echo json_encode(
            array('message' => 'Missing Required Parameters')
        );
    }