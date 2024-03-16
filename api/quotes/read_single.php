<?php  
    // Get Quote Query Results
    
    $result = $quote->read_single();
    $num = $result->rowCount();

    // Check if Quotes
    if ($num > 0){
        // Quotes Array
            // If query used author_id or category_id there might be multiple results
        $quotes_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            // One Quote
            $quotes_item = array(
                'id' => $id,
                'quote' => html_entity_decode($quote),
                'author' => $author,
                'category' => $category
              );

            // Push to Quotes Array
            array_push($quotes_arr, $quotes_item);
        }

        // Turn to JSON & Output
        echo json_encode($quotes_arr);

    } else { 
        // No Quotes
        echo json_encode(
            array('message' => 'No Quotes Found')
        );
    }


    /* <?php  
    // Get Quote Query Results
    $result = $quote->read_single();
    $num = $result->rowCount();
    $quotes_arr = array();

    // Check if Quotes
    if ($num > 0){ // Single Quote
        if ($num == 1 && $quote->id) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            extract($row);

            // Create Quote Array
            $quotes_arr = array(
                'id' => $id,
                'quote' => html_entity_decode($quote),
                'author' => $author,
                'category' => $category
            );

            // Turn to JSON & Output
            echo json_encode($quotes_arr);

        } else { // Quotes from Author and/or Category
            // Quotes Array
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                // One Quote
                $quotes_item = array(
                    'id' => $id,
                    'quote' => html_entity_decode($quote),
                    'author' => $author,
                    'category' => $category
                );

            // Push to Quotes Array
            array_push($quotes_arr, $quotes_item);
            // Turn to JSON & Output
            echo json_encode($quotes_arr);
        }
        }
    } else { 
        // No Quotes
        echo json_encode(
            array('message' => 'No Quotes Found')
        );
    } */