<?php
    $category->category = $data->category;
    
    // Create Category
    if($category->category) {
        $category->create();
        
        // Create Category Array
        $category_arr = array(
            'id' => $db->lastInsertID(),
            'category' => $category->category
        );

        // Display JSON of Category Array
        print_r(json_encode($category_arr));
    } else {
        echo json_encode(
            array('message' => 'Missing Required Parameters')
        );
    }