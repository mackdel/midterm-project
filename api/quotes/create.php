<?php
    // Create Quote
    if($data->quote && $data->author_id && $data->category_id) {
        // Get Data 
        $quote->quote = $data->quote;
        $quote->author_id = $data->author_id;
        $quote->category_id = $data->category_id;

        // Validate it 
        if(!isValid($quote->author_id, $author)) { // Check if author exists
            // Not Valid - Exit
            exit(json_encode( array('message' => 'author_id Not Found')));
        }
        if(!isValid($quote->category_id, $category)) { // Check if category exists
            // Not Valid - Exit
            exit(json_encode( array('message' => 'category_id Not Found')));
        }

        // Execute Request
        $quote->create();

        // Get Author & Quote
        $quote->id = $db->lastInsertID();

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