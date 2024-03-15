<?php  
    // Get Category
    $category->read_single();

    // Create Category Array
    $category_arr = array(
        'id' => $category->id,
        'category' => $category->category
    );

    // Display JSON of Category Array
    print_r(json_encode($category_arr));