<?php 
    // Delete Quote
    if($data->id) {
        // Get Data
        $quote->id = $data->id;
        // Validate it 
        if(!isValid($quote->id, $quote)) {
            // Not Valid - Exit
            exit(json_encode( array('message' => 'No Quotes Found')));
        }

        // Execute Request
        $quote->delete();

        // Create Quote Array
        $quote_arr = array(
            'id' => $quote->id
        );

        // Display JSON of Quote Array
        print_r(json_encode($quote_arr));

    } else {
        echo json_encode(
            array('message' => 'Missing Required Parameters')
        );
    }