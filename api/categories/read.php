<?php 
    // Category Query
        // Call Read method inside Author Class
    $result = $category->read();
        // Get Row Count
    $num = $result->rowCount();

    // Check if Categories
    if ($num > 0){
        // Categories Array
        $categories_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            // One Category
            $category_item = array(
                'id' => $id,
                'category' => $category,
              );

            // Push to Categories Array
            array_push($categories_arr, $category_item);
        }

        // Turn to JSON & Output
        echo json_encode($categories_arr);

    } else { 
        // No Categories
        echo json_encode(
            array('message' => 'No Categories Found')
        );
    }