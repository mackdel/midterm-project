<?php 
    // Author Query
        // Call Read method inside Author Class
    $result = $author->read();
        // Get Row Count
    $num = $result->rowCount();

    // Check if Authors
    if ($num > 0){
        // Authors Array
        $authors_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            // One Author
            $author_item = array(
                'id' => $id,
                'author' => $author,
              );

            // Push to Authors Array
            array_push($authors_arr, $author_item);
        }

        // Turn to JSON & Output
        echo json_encode($authors_arr);

    } else { 
        // No Authors
        echo json_encode(
            array('message' => 'No Authors Found')
        );
    }
