<?php  
    // Get Category
    $result = $category->read_single();

    $row = $result->fetch(PDO::FETCH_ASSOC);

    // Set Properties
    $category->category = $row['category'];

    // Create Category Array
    $category_arr = array(
        'id' => $category->id,
        'category' => $category->category
    );

    // Display JSON of Category Array
    print_r(json_encode($category_arr));