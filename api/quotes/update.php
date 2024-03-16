<?php
    // Update Quote
    if(isset($data->id) && isset($data->quote) && isset($data->author_id) && isset($data->category_id)) {

        // Get Data & Validate 
        $quote->quote = $data->quote;
        $quote->id = $data->id; 
        if(!isValid($quote->id, $quote)) { // Check is quote exists
            // Not Valid - Exit
            exit(json_encode( array('message' => 'No Quotes Found')));
        }
        $quote->author_id = $data->author_id;
        $quote->category_id = $data->category_id;
        if(!isValid($quote->author_id, $author)) { // Check if author exists
            // Not Valid - Exit
            exit(json_encode( array('message' => 'author_id Not Found')));
        }
        if(!isValid($quote->category_id, $category)) { // Check if category exists
            // Not Valid - Exit
            exit(json_encode( array('message' => 'category_id Not Found')));
        }
            
        // Execute Reuqest
        $quote->update();

        // Create Quote Array
        $quote_arr = array(
            'id' => $quote->id,
            'quote' => $quote->quote,
            'author_id' => $quote->author_id,
            'category_id' => $quote->category_id
        );

        // Display JSON of Quote Array
        print_r(json_encode($quote_arr));
    } else {
        echo json_encode(
            array('message' => 'Missing Required Parameters')
        );
    }