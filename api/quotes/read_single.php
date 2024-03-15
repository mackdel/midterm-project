<?php  
    // Get Quote Query Results
    
    $result = $quote->read_single();
    $num = $result->rowCount();
    $quotes_arr = array();

    // Check if Quotes
    if ($num > 0){
        if ($num == 1) {
            // Create Quote Array
            $quote_arr = array(
                'id' => $id,
                'quote' => $quote,
                'author_id' => $author_id,
                'category_id' => $category_id
            );

            // Turn to JSON & Output
            echo json_encode($quotes_arr);
        } else { // If query used author_id or category_id there might be multiple results
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
    }